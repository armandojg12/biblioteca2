<?php

namespace Biblioteca\TegBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;
use Biblioteca\TegBundle\Entity\documento;

/**
 * teg
 *
 * @author Armando Garcia <1211agarcia@gmail.com>
 * @author Currently Working: Armando Garcia <1211agarcia@gmail.com>
 * @version 17/09/2015
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Biblioteca\TegBundle\Entity\tegRepository")
 */
class teg
{
    private static $escuelas = array(
                "Biología"=>"Biología",
                "Computación"=>"Computación", 
                "Física"=>"Física",
                "Matemática"=>"Matemática",
                "Química"=>"Química");

    public static function getSchools() {
        return self::$escuelas;
    }
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * D[Inicial de Escuela]{indica}[año en 2 digitos]
     *
     * @ORM\Column(type="string", length=20, unique=true)
     */
    private $cota;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=20)
     */
    private $escuela;

    /**
     * @var \Date
     *
     * @ORM\Column(type="date")
     */
    private $publicacion;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=500)
     * @Assert\Length(
     *     min=5,
     *     max=500,
     *     minMessage="El titulo es muy corto.",
     *     maxMessage="El titulo es muy largo."
     * )
     */
    private $titulo;

    /**
     * @var array
     *
     * @ORM\Column(type="array")
     */
    private $palabrasClave;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     */
    private $resumen;

    /**
     * @var array
     *
     * @ORM\Column(type="array")
     */
    private $autores;

    /**
     * @var array
     *
     * @ORM\Column(type="array")
     */
    private $tutores;

    /**
     * @var array
     *
     * @ORM\OneToMany(targetEntity="documento", mappedBy="teg") 
     * @Assert\Valid
     */
    protected $capitulos;

    /**
     * @var datetime $created
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @var datetime $updated
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    private $updated;

    /**
     * @var boolean $published
     *
     * @ORM\Column(type="boolean")
     */
    private $published;

    public function __construct()
    {
        $this->autores = new ArrayCollection(array(''));
        $this->tutores = new ArrayCollection(array(''));
        $this->palabrasClave = new ArrayCollection(array('','',''));
        $this->capitulos = new ArrayCollection(array(new documento()));
        $this->published = true;
    }


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
     * Set cota
     *
     * @param string $cota
     * @return teg
     */
    public function setCota($cota)
    {
        $this->cota = $cota;

        return $this;
    }

    /**
     * Get cota
     *
     * @return string 
     */
    public function getCota()
    {
        return $this->cota;
    }

    /**
     * Set escuela
     *
     * @param string $escuela
     * @return teg
     */
    public function setEscuela($escuela)
    {
        $this->escuela = $escuela;

        return $this;
    }

    /**
     * Get escuela
     *
     * @return string 
     */
    public function getEscuela()
    {
        return $this->escuela;
    }

    /**
     * Set publicacion
     *
     * @param \Date $publicacion
     * @return teg
     */
    public function setPublicacion($publicacion)
    {
        $this->publicacion = $publicacion;

        return $this;
    }

    /**
     * Get publicacion
     *
     * @return \Date 
     */
    public function getPublicacion()
    {
        return $this->publicacion;
    }

    /**
     * Set titulo
     *
     * @param string $titulo
     * @return teg
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get titulo
     *
     * @return string 
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set palabrasClave
     *
     * @param array $palabrasClave
     * @return teg
     */
    public function setPalabrasClave($palabrasClave)
    {
        $this->palabrasClave = $palabrasClave;

        return $this;
    }

    /**
     * Get palabrasClave
     *
     * @return array 
     */
    public function getPalabrasClave()
    {
        return $this->palabrasClave;
    }

    /**
     * Set resumen
     *
     * @param string $resumen
     * @return teg
     */
    public function setResumen($resumen)
    {
        $this->resumen = $resumen;

        return $this;
    }

    /**
     * Get resumen
     *
     * @return string 
     */
    public function getResumen()
    {
        return $this->resumen;
    }

    /**
     * Set autores
     *
     * @param array $autores
     * @return teg
     */
    public function setAutores($autores)
    {
        $this->autores = $autores;
        return $this;
    }

    /**
     * Get autores
     *
     * @return array
     */
    public function getAutores()
    {
       return $this->autores;
  //     return implode(",", $this->autores);
      
    }

    /**
     * Set tutores
     *
     * @param array $tutores
     * @return teg
     */
    public function setTutores($tutores)
    {
        $this->tutores = $tutores;
        return $this;
    }

    /**
     * Get tutores
     *
     * @return array
     */
    public function getTutores()
    {
       return $this->tutores;
      
    }

    public function __toString() {
        return sprintf('%d at %s (%s)', $this->getId(), $this->getCota(), $this->getTitulo());
    }
  

    /**
     * Add capitulos
     *
     * @param \Biblioteca\TegBundle\Entity\documento $capitulos
     * @return teg
     */
    public function addCapitulo(\Biblioteca\TegBundle\Entity\documento $capitulos)
    {
        $this->capitulos[] = $capitulos;
        $capitulos->setTeg($this);
        return $this;

        return $this;
    }

    /**
     * Remove capitulos
     *
     * @param \Biblioteca\TegBundle\Entity\documento $capitulos
     */
    public function removeCapitulo(\Biblioteca\TegBundle\Entity\documento $capitulos)
    {
        $this->capitulos->removeElement($capitulos);
    }

    /**
     * Remove capitulos
     *
     */
    public function removeAllCapitulos()
    {
        unset($this->capitulos);
        $this->capitulos = new ArrayCollection();
    }

    /**
     * Get capitulos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCapitulos()
    {
        return $this->capitulos;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return teg
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     * @return teg
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime 
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set published
     *
     * @param boolean $published
     * @return teg
     */
    public function setPublished($published)
    {
        $this->published = $published;

        return $this;
    }

    /**
     * Get published
     *
     * @return boolean 
     */
    public function getPublished()
    {
        return $this->published;
    }
}
