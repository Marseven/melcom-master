<?php
declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\ORM\Locator\LocatorAwareTrait;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/4/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('FormProtection');`
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Csrf');
        $this->loadComponent('Auth', [
            'authorize' => 'Controller',
            'loginAction' => [
                'controller' => 'Users',
                'action' => 'login',
            ],
            'loginRedirect' => [
                'controller' => 'Melcom',
                'action' => 'index',
            ],
            'logoutRedirect' => [
                'controller' => 'Melcom',
                'action' => 'index',
            ],
            'authError' => 'Enregistrez-vous ou Connectez-vous',
            'authenticate' => [
                'Form' => [
                    'fields' => ['username' => 'email', 'password' => 'password']
                ]
            ]
            ]
        );
        $this->loadComponent('FormProtection');
    }

    public function isAuthorized($user)
    {
        // Par défaut n'autorise pas
        return true;
    }

    public function tableCat($variable){
      $table = [];
      foreach ($variable as $key) {
        $table[$key->id_categorie] = $key->libelle;
      }
      return $table;
    }

    public function tableEnt($variable){
      $table = [];
      foreach ($variable as $key) {
        $table[$key->id_entreprise] = $key->nom;
      }
      return $table;
    }

    public function tableAnc($variable){
        $table = [];
        foreach ($variable as $key) {
          $table[$key->id_annonce] = $key->titre;
        }
        return $table;
      }

    static function change_format_date($date){
        $date = new \DateTime($date);
        $date = $date->format('d-m-Y H:i');
        return $date;
    }

    static function article_format_date($date){
        $intl_date_formatter = new \IntlDateFormatter('fr_FR',
                                           \IntlDateFormatter::FULL,
                                           \IntlDateFormatter::NONE);
        $date = new \DateTime($date);
        //$date = $date->format('d F Y');
        $date = $intl_date_formatter->format($date);
        $date = explode(' ', $date);
        $date = $date[1]." <span>".$date[2]." ".$date[3]."</span>";
        return $date;
    }

    //tranformer les nombres en chaîne de caractères
    static  function change_number_format($number){

        $chaine = "".$number."";
        if (strlen($chaine) <= 3) {
            return $chaine;
        }else{
            $decimal = "";
            $millier = "";
            $cnt = 0;
            $taille = strlen($chaine);
            for($i = 0; $i < $taille; $i++){

                if ($taille == 4) {
                    if($cnt < 1){
                        $millier .= $chaine[$i];
                    }
                    if ($cnt >= 1) {
                        $decimal .= $chaine[$i];
                    }
                }elseif ($taille == 5) {
                    if($cnt < 2){
                        $millier .= $chaine[$i];
                    }
                    if ($cnt >= 2) {
                        $decimal .= $chaine[$i];
                    }
                }elseif ($taille == 6) {
                    if($cnt < 3){
                        $millier .= $chaine[$i];
                    }
                    if ($cnt >= 3) {
                        $decimal .= $chaine[$i];
                    }
                }
                $cnt++;
            }
            $chaine = $millier." ".$decimal;
        }

        return $chaine;
    }

    //différence de temps en nombre d'heure
    static function difference_temps(\DateTime $debut, \DateTime $fin){
        $intervalle = $fin->diff($debut);
        $jour = (int)$intervalle->d;
        $entier = (int)$intervalle->h;
        $decimal = (int)$intervalle->i/60;
        $nbre_heure = round($entier+$decimal, 2);
        if($jour != 0){
            $nbre_heure = 3.00;
        }
        return $nbre_heure;
    }

    static function date_verified($date1, $date2){
        $aujourdhui = date('Y-m-d H:m');

        $aujourdhui = new \DateTime($aujourdhui);
        $date_depart = new \DateTime($date1);
        $date_arriver = new \DateTime($date2);

        if ($aujourdhui >= $date_depart || $date_depart >= $date_arriver || $aujourdhui >= $date_arriver) {
            return false;
        }

        $infos = array();
        $infos['depart'] = $date_depart;
        $infos['arriver'] = $date_arriver;

        return $infos;

    }

    static function str_random($length){
        $alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
        return substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length);
    }

    public function menu($valeur){
        $home = '';
        $about = '';
        $annonces = '';
        $postuler = '';
        $contacter = '';
        if ($valeur == 'home') {
          $home = 'active';
        }elseif ($valeur == 'about') {
          $about = 'active';
        }elseif ($valeur == 'annonces') {
          $communication = 'active';
        }elseif ($valeur == 'postuler') {
          $informatique = 'active';
        }elseif ($valeur == 'contacter') {
          $contacter = 'active';
        }
        $this->set(array(
            'home' => $home,
            'about' => $about,
            'ance' => $annonces,
            'postuler' => $postuler,
            'contacter' => $contacter,
        ));
    }

}
