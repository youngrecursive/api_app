<?php

namespace App\Command;

use App\Service\CallApiService;
use App\Entity\Societe;
use App\Repository\SocieteRepository;
use App\Utils\CustomValidatorForCommand;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Exception\InvalidArgumentException;
use Symfony\Component\Console\Exception\RuntimeException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Style\SymfonyStyle;

class AddSocieteCommand extends Command
{
    protected static $defaultName = 'addsociete';
    protected static $defaultDescription = 'Ajouter une entreprise à partir de son siret';

    private CustomValidatorForCommand $validator;
    private EntityManagerInterface $entityManager;
    private SymfonyStyle $io;
    private SocieteRepository $societeRepository;

    public function __construct(
        CallApiService $callApiService,
        CustomValidatorForCommand $validator,
        EntityManagerInterface $entityManager,
        SocieteRepository $societeRepository

    )
    {
        parent::__construct();
        $this->callApiService = $callApiService;
        $this->validator = $validator;
        $this->entityManager = $entityManager;
        $this->societeRepository = $societeRepository;
    }

    protected function configure(): void
    {
        $this
            ->addArgument('siret', InputArgument::REQUIRED, 'Numero siret');
    }


    protected function initialize(InputInterface $input, OutputInterface $output): void
    {
        $this->io = new SymfonyStyle($input, $output);
    }


    protected function interact(InputInterface $input, OutputInterface $output): void
    {
        $this->io->section("Ajout d'une société en base de données");
        $this->enterSociete($input, $output);
    }


    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        /** @var string $siret */
        $siret = $input->getArgument('siret');
        $call = $this->callApiService->getData($siret);
        if (empty($call)){
            throw new InvalidArgumentException('Numéro de siret ne correspond à aucune societé connue');
        }
        $societe = new Societe();
        $societe->setSiret($siret);
        $societe->setNic($call['etablissement']['nic']);
        $societe->setSiren($call['etablissement']['siren']);
        $societe->setDateCreation(new \DateTime($call['etablissement']['dateCreationEtablissement']));
        $societe->setEtablissementSiege($call['etablissement']['etablissementSiege']);
        $nom_unite = $call['etablissement']['uniteLegale']['nomUniteLegale'];
        if (empty($nom_unite)) { $nom_unite = 'no name'; }
        $societe->setNomUniteLegale($nom_unite);
        $societe->setCodePostal($call['etablissement']['adresseEtablissement']['codePostalEtablissement']);
        $societe->setVille($call['etablissement']['adresseEtablissement']['libelleCommuneEtablissement']);
        $societe->setNomSociete($call['etablissement']['periodesEtablissement'][0]['denominationUsuelleEtablissement']);
        $societe->setNumeroVoieEtablissement($call['etablissement']['adresseEtablissement']['numeroVoieEtablissement']);
        $societe->setTypeVoieEtablissement($call['etablissement']['adresseEtablissement']['typeVoieEtablissement']);
        $societe->setLibelleVoieEtablissement($call['etablissement']['adresseEtablissement']['libelleCommuneEtablissement']);


        $this->entityManager->persist($societe);
        $this->entityManager->flush();
        $this->io->success("Une nouvelle société vient d'être ajoutée !");


        return Command::SUCCESS;
    }

    private function enterSociete(InputInterface $input, OutputInterface $output): void
    {
        $helper = $this->getHelper('question');
        $societeQuestion = new Question('VEUILLEZ ECRIRE LE NUMERO DE SIRET>');
        $societeQuestion->setValidator([$this->validator, 'validateSiret']);
        $siret = $helper->ask($input, $output, $societeQuestion);

        if ($this->societeAlreadyExists($siret)) {
            throw new RuntimeException(sprintf("Societé deja présente en bdd avec le numéro de siret : %s", $siret));
        }

        $input->setArgument('siret', $siret);
    }

    private function societeAlreadyExists(string $siret)
    {
        return $this->societeRepository->findOneBy([
            'siret' => $siret
        ]);
    }


}
