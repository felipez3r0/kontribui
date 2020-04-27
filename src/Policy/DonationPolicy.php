<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Donation;
use Authorization\IdentityInterface;

/**
 * Donation policy
 */
class DonationPolicy
{
    /**
     * Check if $user can create Donation
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Donation $resource
     * @return bool
     */
    public function canAdd(IdentityInterface $user, Donation $resource)
    {
        $areas = $user->getOriginalData()->areas_list;
        if(in_array('donations->add',$areas)){
            return true;
        }

        return false;        
    }

    /**
     * Check if $user can update Donation
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Donation $resource
     * @return bool
     */
    public function canEdit(IdentityInterface $user, Donation $resource)
    {
        $areas = $user->getOriginalData()->areas_list;
        if(in_array('donations->edit',$areas) || $this->isUser($user->getOriginalData()->id, $resource)){
            return true;
        }

        return false;          
    }

    /**
     * Check if $user can delete Donation
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Donation $resource
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Donation $resource)
    {
        $areas = $user->getOriginalData()->areas_list;
        if(in_array('donations->edit',$areas)){
            return true;
        }

        return false;          
    }

    /**
     * Check if $user can view Donation
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Donation $resource
     * @return bool
     */
    public function canIndex(IdentityInterface $user, Donation $resource)
    {
        $areas = $user->getOriginalData()->areas_list;
        if(in_array('donations->index',$areas)){
            return true;
        }

        return false;
    }

    /**
     * Check if $user can view Donation
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Donation $resource
     * @return bool
     */
    public function canView(IdentityInterface $user, Donation $resource)
    {
        $areas = $user->getOriginalData()->areas_list;
        if(in_array('donations->index',$areas) || $this->isUser($user->getOriginalData()->id, $resource)){
            return true;
        }

        return false;           
    }   
    
    protected function isUser($id, Donation $part)
    {
        return $part->project->user_id === $id;
    }    
}
