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
interface EntityModel extends Model
{

    /**
     * @return mixed
     */
    public function getId();

    /**
     * @return DateTime
     */
    public function getCreatedAt():DateTime;

    /**
     * @return DateTime
     */
    public function getUpdatedAt():DateTime;

    /**
     * @return DateTime
     */
    public function getDeletedAt();

    public function update();

    public function delete();
}
