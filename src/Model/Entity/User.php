<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;
/**
 * User Entity.
 *
 * @property int $id
 * @property string $title
 * @property string $body
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 */
class User extends Entity
{
    protected function _setPassword($password)
    {
        if (strlen($password) > 0) {
            return (new DefaultPasswordHasher)->hash($password);
        }
    }
}
