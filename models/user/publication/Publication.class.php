<?php
class Publication
{
    private $id;    
    private $seller;
    private $title;
    private $description;
    private $image;
    private $minimal_price;
    private $offer_list;

    public function __construct($id, $seller, $title, $description, $image, $minimalPrice)
    {
        $this->id = $id;
        $this->seller = $seller;
        $this->title= $title;
        $this->description = $description;
        $this->image = $image;
        $this->minimal_price = $minimalPrice;
    }    
    //getters et setters
    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
    public function getSeller()
    {
        return $this->seller;
    }
    public function setSeller($seller)
    {
        $this->seller = $seller;
    }
    public function getTitle()
    {
        return $this->title;
    }
    public function setTitle($title)
    {
        $this->title = $title;
    }
    public function getDescription()
    {
        return $this->description;
    }
    public function setDescription($description)
    {
        $this->description = $description;
    }
    public function getImage()
    {
        return $this->image;
    }
    public function setImage($image)
    {
        $this->image = $image;
    }
    public function getMinimalPrice()
    {
        return $this->minimal_price;
    }
    public function setMinimalPrice($minimalPrice)
    {
        $this->minimal_price= $minimalPrice;
    } 
    public function getOfferList()
    {
        return $this->offer_list;
    }
    public function setOfferList($offerList)
    {
        $this->offer_list= $offerList;
    } 
}

