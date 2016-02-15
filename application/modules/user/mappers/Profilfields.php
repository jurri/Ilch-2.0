<?php
/**
 * @copyright Ilch 2.0
 * @package ilch
 */

namespace Modules\User\Mappers;

use Modules\User\Models\Profilfields as ProfilfieldsModel;
use Ilch\Date as IlchDate;

class Profilfields extends \Ilch\Mapper
{
    /**
     * Returns user model found by the id.
     *
     * @param  int $id
     * @return null|\Modules\User\Models\User
     */
    public function getUserById($id)
    {
        $where = array
        (
            'id' => (int)$id,
        );

        $users = $this->getBy($where);

        if (!empty($users)) {
            return reset($users);
        }

        return null;
    }

    /**
     * Returns user model found by the username.
     *
     * @param  string $name
     * @return null|\Modules\User\Models\User
     */
    public function getUserByName($name)
    {
        $where = array
        (
            'name' => (string)$name,
        );

        $users = $this->getBy($where);

        if (!empty($users)) {
            return reset($users);
        }

        return null;
    }

    /**
     * Returns user model found by the email.
     *
     * @param  string $email
     * @return null|\Modules\User\Models\User
     */
    public function getUserByEmail($email)
    {
        $where = array
        (
            'email' => (string)$email,
        );

        $users = $this->getBy($where);

        if (!empty($users)) {
            return reset($users);
        }

        return null;
    }

    /**
     * Returns user model found by the confirmed_code.
     *
     * @param  string $confirmed
     * @return null|\Modules\User\Models\User
     */
    public function getUserByConfirmedCode($confirmed)
    {
        $where = array
        (
            'confirmed_code' => (string)$confirmed,
        );

        $users = $this->getBy($where);

        if (!empty($users)) {
            return reset($users);
        }

        return null;
    }

    /**
     * Returns an array with user models found by the where clause of false if
     * none found.
     *
     * @param  array $where
     * @return null|\Modules\User\Models\User[]
     */
    protected function getBy($where = [])
    {
        $userRows = $this->db()->select('*')
            ->from('users')
            ->where($where)
            ->execute()
            ->fetchRows();

        if (!empty($userRows)) {
            $users = array();

            foreach ($userRows as $userRow) {
                $groups = array();
                $sql = 'SELECT g.*
                        FROM `[prefix]_groups` AS g
                        INNER JOIN `[prefix]_users_groups` AS ug ON g.id = ug.group_id
                        WHERE ug.user_id = ' . $userRow['id'];
                $groupRows = $this->db()->queryArray($sql);
                $groupMapper = new Group();

                foreach ($groupRows as $groupRow) {
                    $groups[$groupRow['id']] = $groupMapper->loadFromArray($groupRow);
                }

                $user = $this->loadFromArray($userRow);
                $user->setGroups($groups);
                $users[] = $user;
            }

            return $users;
        }

        return null;
    }

    /**
     * Returns a user created using an array with user data.
     *
     * @param  mixed[] $userRow
     * @return UserModel
     */
    public function loadFromArray($userRow = array())
    {
        $user = new ProfilfieldsModel();

        if (isset($userRow['id'])) {
            $user->setId($userRow['id']);
        }

        if (isset($userRow['name'])) {
            $user->setName($userRow['name']);
        }

        if (isset($userRow['icon'])) {
            $user->setEmail($userRow['icon']);
        }

        return $user;
    }

    /**
     * Inserts or updates a user model in the database.
     *
     * @param UserModel $user
     *
     * @return int The userId of the updated or inserted user.
     */
    public function save(ProfilfieldsModel $profilfield)
    {
        $fields = array();
        $name = $profilfield->getName();
        $email = $profilfield->getIcon();

        if (!empty($name)) {
            $fields['name'] = $user->getName();
        }

        if (!empty($icon)) {
            $fields['icon'] = $user->getIcon();
        }


        $userId = (int)$this->db()->select('id')
            ->from('user_profilfields')
            ->where(array('id' => $profilfield->getId()))
            ->execute()
            ->fetchCell();

        if ($profilfieldId) {
            /*
             * User does exist already, update.
             */
            $this->db()->update('user_profilfields')
                ->values($fields)
                ->where(array('id' => $profilfieldId))
                ->execute();
        } else {

            /*
             * User does not exist yet, insert.
             */
            $profilfieldId = $this->db()->insert('user_profilfields')
                ->values($fields)
                ->execute();
        }

        if ($profilfield->getGroups()) {
            $this->db()->delete('users_groups')
                ->where(array('user_id' => $userId))
                ->execute();

            foreach ($profilfield->getGroups() as $group) {
                $this->db()->insert('users_groups')
                    ->values(array('user_id' => $userId, 'group_id' => $group->getId()))
                    ->execute();
            }
        }

        return $profilfieldId;
    }

    /**
     * Returns a array of all user model objects.
     *
     * @param array|mixed $where
     *
     * @return UserModel[]
     */
    public function getProfilfieldList($where = [])
    {
        return $this->getBy($where);
    }

    /**
     * Returns whether a user exists.
     *
     * @param  int $userId
     *
     * @return boolean True if a user with this id exists, false otherwise.
     */
    public function profilfieldWithIdExists($profilfieldId)
    {
        $userExists = (bool)$this->db()->select('id')
            ->from('user_profilfields')
            ->where(array('id' => $profilfieldId))
            ->execute()
            ->fetchCell();

        return $userExists;
    }

    /**
     * Deletes a given user or a user with the given id.
     *
     * @param  int|UserModel $userId
     *
     * @return boolean True of success, otherwise false.
     */
    public function delete($profilfieldId)
    {
        if (is_a($profilfieldId, '\Modules\User\Models\Profilfields')) {
            $profilfieldId = $profilfieldId->getId();
        }

        return $this->db()->delete('user_profilfields')
            ->where(array('id' => $profilfieldId))
            ->execute();
    }
}
