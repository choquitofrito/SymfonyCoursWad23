<?php

namespace App\Entity;


class RechercheLivrePrix {
    private float $minPrix;
    private float $maxPrix;

    /**
     * Get the value of minPrix
     */ 
    public function getMinPrix()
    {
        return $this->minPrix;
    }

    /**
     * Set the value of minPrix
     *
     * @return  self
     */ 
    public function setMinPrix($minPrix)
    {
        $this->minPrix = $minPrix;

        return $this;
    }

    /**
     * Get the value of maxPrix
     */ 
    public function getMaxPrix()
    {
        return $this->maxPrix;
    }

    /**
     * Set the value of maxPrix
     *
     * @return  self
     */ 
    public function setMaxPrix($maxPrix)
    {
        $this->maxPrix = $maxPrix;

        return $this;
    }
}
