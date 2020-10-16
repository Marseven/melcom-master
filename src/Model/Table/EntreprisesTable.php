<?php
namespace App\Model\Table;

use App\Model\Entity\Category;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Search\Manager;

/**
 * Entreprises Model
 *
 * @property \Cake\ORM\Association\HasMany $Articles
 */
class EntreprisesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) : void
    {
        parent::initialize($config);

        $this->setTable('entreprises');

        $this->hasMany('annonces')
        ->setForeignKey('id_entreprise')
        ->setDependent(true);

        $this->belongsTo('users')
        ->setForeignKey('id_user') // Avant la version CakePHP 3.4, utilisez foreignKey() au lieu de setForeignKey()
        ->setJoinType('INNER');

        // Add the behavior to your table
        $this->addBehavior('Search.Search');

        // Setup search filter using search manager
        $this->searchManager()
            ->value('id_annonce')
            ->add('q', 'Search.Like', [
                'before' => true,
                'after' => true,
                'fieldMode' => 'OR',
                'comparison' => 'LIKE',
                'wildcardAny' => '*',
                'wildcardOne' => '?',
                'fields' => ['nom', 'secteur'],
            ]);
    }

}
