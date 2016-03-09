<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Veloci\Core\Model;
use DateTime;

/**
 *
 * @author christian
 */
interface EntityModel
{

    /**
     * @return mixed
     */
    public function getId();

    /**
     * @return DateTime
     */
    public function getCreatedAt();

    /**
     * @return DateTime
     */
    public function getUpdatedAt();

    /**
     * @return DateTime
     */
    public function getDeletedAt();

    /**
     * @return boolean
     */
    public function isDeleted();

    public function update();

    public function delete();
}
