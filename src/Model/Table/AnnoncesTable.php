<?php
namespace App\Model\Table;

use App\Model\Entity\Article;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Search\Manager;

/**
 * Annonces Model
 * 
 * @mixin \Search\Model\Behavior\SearchBehavior
 *
 */
class AnnoncesTable extends Table
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

        $this->setTable('annonces');

        $this->belongsTo('Users', [
            'foreignKey' => 'id_user',
        ]);

        $this->belongsTo('Entreprises', [
            'foreignKey' => 'id_entreprise',
        ]);
        
        $this->belongsToMany('Categories');

        $this->belongsToMany('Candidats');

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
                'fields' => ['titre', 'description', 'competences'],
            ]);
    }

    public function isOwnedBy($articleId, $userId)
    {
        return $this->exists(['id' => $articleId, 'user_id' => $userId]);
    }
}
