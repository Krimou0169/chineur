<?php
class Offer
{
    private $id;    
    private $buyer;
    private $text;
    private $price_proposal;
    private $status;
    private $final_choice;
    private $publication;
    private $seller;

    public function __construct($id, $buyer, $text, $priceProposal, $status, $finalChoice, $publication, $seller)
    {
        $this->id = $id;
        $this->buyer = $buyer;
        $this->text= $text;
        $this->price_proposal = $priceProposal;
        $this->status = $status;
        $this->final_choice = $finalChoice;
        $this->publication = $publication;
        $this->seller = $seller;
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
    public function getBuyer()
    {
        return $this->buyer;
    }
    public function setBuyer($buyer)
    {
        $this->buyer = $buyer;
    }
    public function getText()
    {
        return $this->text;
    }
    public function setText($text)
    {
        $this->text = $text;
    }
    public function getPriceProposal()
    {
        return $this->price_proposal;
    }
    public function setPriceProposal($priceProposal)
    {
        $this->price_proposal = $priceProposal;
    }
    public function getStatus()
    {
        return $this->status;
    }
    public function setStatus($status)
    {
        $this->status= $status;
    } 
    public function getFinalChoice()
    {
        return $this->final_choice;
    }
    public function setFinalChoice($finalChoice)
    {
        $this->final_choice= $finalChoice;
    } 
    public function getPublication()
    {
        return $this->publication;
    }
    public function setPublication($publication)
    {
        $this->publication= $publication;
    }
    public function getSeller()
    {
        return $this->seller;
    }
    public function setSeller($seller)
    {
        $this->seller = $seller;
    }
}

