<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Project;
use Authorization\IdentityInterface;

/**
 * Project policy
 */
class ProjectPolicy
{
    /**
     * Check if $user can create Project
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Project $resource
     * @return bool
     */
    public function canAdd(IdentityInterface $user, Project $resource)
    {
        $areas = $user->getOriginalData()->areas_list;
        if(in_array('projects->add',$areas)){
            return true;
        }

        return false;        
    }

    /**
     * Check if $user can update Project
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Project $resource
     * @return bool
     */
    public function canEdit(IdentityInterface $user, Project $resource)
    {
        $areas = $user->getOriginalData()->areas_list;
        if(in_array('projects->edit',$areas) || $this->isUser($user->getOriginalData()->id, $resource)){
            return true;
        }

        return false;          
    }

    /**
     * Check if $user can delete Project
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Project $resource
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Project $resource)
    {
        $areas = $user->getOriginalData()->areas_list;
        if(in_array('projects->edit',$areas)){
            return true;
        }

        return false;          
    }

    /**
     * Check if $user can view Project
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Project $resource
     * @return bool
     */
    public function canIndex(IdentityInterface $user, Project $resource)
    {
        $areas = $user->getOriginalData()->areas_list;
        if(in_array('projects->index',$areas)){
            return true;
        }

        return false;
    }

    /**
     * Check if $user can list Project
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Project $resource
     * @return bool
     */
    public function canList(IdentityInterface $user, Project $resource)
    {
        $areas = $user->getOriginalData()->areas_list;
        if(in_array('projects->list',$areas)){
            return true;
        }

        return false;
    }    

    /**
     * Check if $user can view Project
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Project $resource
     * @return bool
     */
    public function canView(IdentityInterface $user, Project $resource)
    {
        $areas = $user->getOriginalData()->areas_list;
        if(in_array('projects->index',$areas) || $this->isUser($user->getOriginalData()->id, $resource)){
            return true;
        }

        return false;           
    }   
    
    protected function isUser($id, Project $project)
    {
        return $project->user_id === $id;
    }    
}
