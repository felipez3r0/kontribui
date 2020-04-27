<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Part;
use Authorization\IdentityInterface;

/**
 * Part policy
 */
class PartPolicy
{
    /**
     * Check if $user can create Part
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Part $resource
     * @return bool
     */
    public function canAdd(IdentityInterface $user, Part $resource)
    {
        $areas = $user->getOriginalData()->areas_list;
        if(in_array('parts->add',$areas)){
            return true;
        }

        return false;        
    }

    /**
     * Check if $user can update Part
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Part $resource
     * @return bool
     */
    public function canEdit(IdentityInterface $user, Part $resource)
    {
        $areas = $user->getOriginalData()->areas_list;
        if(in_array('parts->edit',$areas) || $this->isUser($user->getOriginalData()->id, $resource)){
            return true;
        }

        return false;          
    }

    /**
     * Check if $user can delete Part
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Part $resource
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Part $resource)
    {
        $areas = $user->getOriginalData()->areas_list;
        if(in_array('parts->edit',$areas)){
            return true;
        }

        return false;          
    }

    /**
     * Check if $user can view Part
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Part $resource
     * @return bool
     */
    public function canIndex(IdentityInterface $user, Part $resource)
    {
        $areas = $user->getOriginalData()->areas_list;
        if(in_array('parts->index',$areas)){
            return true;
        }

        return false;
    }

    /**
     * Check if $user can view Part
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Part $resource
     * @return bool
     */
    public function canView(IdentityInterface $user, Part $resource)
    {
        $areas = $user->getOriginalData()->areas_list;
        if(in_array('parts->index',$areas) || $this->isUser($user->getOriginalData()->id, $resource)){
            return true;
        }

        return false;           
    }   
    
    protected function isUser($id, Part $part)
    {
        return $part->project->user_id === $id;
    }    
}
