<?php

namespace VoterBundle\Model;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class VoterModel
 *
 * @package VoterBundle\Model
 */
class VoterModel
{
    protected $select;

    /**
     * Get select
     *
     * @return VoterModel
     */
    public function getSelect()
    {
        return $this->select;
    }

    /**
     * Add select
     *
     * @param int $select
     *
     * @return VoterModel
     */
    public function setSelect($select)
    {
        $this->select = $select;

        return $this;
    }


}
