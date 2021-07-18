<?php

namespace App\Entity;

use App\Repository\SocieteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SocieteRepository::class)
 */
class Societe
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $siret;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $nic;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $siren;

    /**
     * @ORM\Column(type="datetime")
     */
    private $DateCreation;

    /**
     * @ORM\Column(type="binary")
     */
    private $etablissementSiege;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $NomUniteLegale;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    private $codePostal;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $ville;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nomSociete;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $numeroVoieEtablissement;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $typeVoieEtablissement;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $libelleVoieEtablissement;


    public function getSiret(): ?string
    {
        return $this->siret;
    }

    public function setSiret(string $siret): self
    {
        $this->siret = $siret;

        return $this;
    }

    public function getNic(): ?string
    {
        return $this->nic;
    }

    public function setNic(string $nic): self
    {
        $this->nic = $nic;

        return $this;
    }

    public function getSiren(): ?string
    {
        return $this->siren;
    }

    public function setSiren(string $siren): self
    {
        $this->siren = $siren;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->DateCreation;
    }

    public function setDateCreation(\DateTimeInterface $DateCreation): self
    {
        $this->DateCreation = $DateCreation;

        return $this;
    }

    public function getEtablissementSiege()
    {
        return $this->etablissementSiege;
    }

    public function setEtablissementSiege($etablissementSiege): self
    {
        $this->etablissementSiege = $etablissementSiege;

        return $this;
    }

    public function getNomUniteLegale(): ?string
    {
        return $this->NomUniteLegale;
    }

    public function setNomUniteLegale(string $NomUniteLegale): self
    {
        $this->NomUniteLegale = $NomUniteLegale;

        return $this;
    }

    public function getCodePostal(): ?string
    {
        return $this->codePostal;
    }

    public function setCodePostal(string $codePostal): self
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getNomSociete(): ?string
    {
        return $this->nomSociete;
    }

    public function setNomSociete(?string $nomSociete): self
    {
        $this->nomSociete = $nomSociete;

        return $this;
    }

    public function getNumeroVoieEtablissement(): ?string
    {
        return $this->numeroVoieEtablissement;
    }

    public function setNumeroVoieEtablissement(?string $numeroVoieEtablissement): self
    {
        $this->numeroVoieEtablissement = $numeroVoieEtablissement;

        return $this;
    }

    public function getTypeVoieEtablissement(): ?string
    {
        return $this->typeVoieEtablissement;
    }

    public function setTypeVoieEtablissement(?string $typeVoieEtablissement): self
    {
        $this->typeVoieEtablissement = $typeVoieEtablissement;

        return $this;
    }

    public function getLibelleVoieEtablissement(): ?string
    {
        return $this->libelleVoieEtablissement;
    }

    public function setLibelleVoieEtablissement(?string $libelleVoieEtablissement): self
    {
        $this->libelleVoieEtablissement = $libelleVoieEtablissement;

        return $this;
    }


}
