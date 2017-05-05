<?php

namespace AppBundle\Entity;

/**
 * Interessado
 */
class Interessado
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $nome;

    /**
     * @var string
     */
    private $endereco;

    /**
     * @var string
     */
    private $telefone;

    /**
     * @var \DateTime
     */
    private $dataNascimento;

    /**
     * @var \AppBundle\Entity\Convite
     */
    private $convite;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nome
     *
     * @param string $nome
     *
     * @return Interessado
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get nome
     *
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set endereco
     *
     * @param string $endereco
     *
     * @return Interessado
     */
    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;

        return $this;
    }

    /**
     * Get endereco
     *
     * @return string
     */
    public function getEndereco()
    {
        return $this->endereco;
    }

    /**
     * Set telefone
     *
     * @param string $telefone
     *
     * @return Interessado
     */
    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;

        return $this;
    }

    /**
     * Get telefone
     *
     * @return string
     */
    public function getTelefone()
    {
        return $this->telefone;
    }

    /**
     * Set dataNascimento
     *
     * @param \DateTime $dataNascimento
     *
     * @return Interessado
     */
    public function setDataNascimento($dataNascimento)
    {
        $this->dataNascimento = $dataNascimento;

        return $this;
    }

    /**
     * Get dataNascimento
     *
     * @return \DateTime
     */
    public function getDataNascimento()
    {
        return $this->dataNascimento;
    }

    /**
     * Set convite
     *
     * @param \AppBundle\Entity\Convite $convite
     *
     * @return Interessado
     */
    public function setConvite(\AppBundle\Entity\Convite $convite = null)
    {
        $this->convite = $convite;

        return $this;
    }

    /**
     * Get convite
     *
     * @return \AppBundle\Entity\Convite
     */
    public function getConvite()
    {
        return $this->convite;
    }
}

