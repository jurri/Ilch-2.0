<?php
/**
 * @copyright Ilch 2.0
 * @package ilch
 */

namespace Modules\User\Models;

class Profilfields extends \Ilch\Model
{
    /**
     * The id of the user.
     *
     * @var int
     */
    protected $id;

    /**
     * The name of the profilfield.
     *
     * @var string
     */
    protected $name;

    /**
     * The icon address of the profilfield.
     *
     * @var string
     */
    protected $icon;

    
    protected $groups = array();

    /**
     * Returns the id of the user.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Saves the id of the user.
     *
     * @param int $id
     * @return User
     */
    public function setId($id)
    {
        $this->id = (int)$id;

        return $this;
    }

    /**
     * Returns the username.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Saves the username.
     *
     * @param string $username
     * @return User
     */
    public function setName($name)
    {
        $this->name = (string)$name;

        return $this;
    }

    /**
     * Returns the email address of the user.
     *
     * @return string
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * Saves the email address of the user.
     *
     * @param string $email
     * @return User
     */
    public function setiÍcon($icon)
    {
        $this->icon = (string)$icon;

        return $this;
    }

    /**
     * Saves the groups of the user.
     *
     * @return Group[]
     */
    public function getGroups()
    {
        return $this->groups;
    }

    /**
     * Sets the groups of the user.
     *
     * @param Group[] $groups
     * @return User
     */
    public function setGroups($groups)
    {
        $this->groups = $groups;

        return $this;
    }

    /**
     * Adds a group to the users groups.
     *
     * @param Group $group
     * @return User
     */
    public function addGroup(Group $group)
    {
        if (!isset($this->groups[$group->getId()])) {
            $this->groups[$group->getId()] = $group;
        }

        return $this;
    }

    /**
     * Checks if user has the given group.
     *
     * @param integer $groupId
     * @return boolean
     */
    public function hasGroup($groupId)
    {
        if (!isset($this->groups[$groupId])) {
            return false;
        }

        return true;
    }
}
