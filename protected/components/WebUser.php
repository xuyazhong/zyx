<?php
/**
 * @property boolean $isAdmin
 * @property boolean $isSuperAdmin
 * @property User $user
 */
class WebUser extends CWebUser{
 /**
  * cache for the logged in User active record
  * @return User
  */
 private $_user;
 /**
  * is the user a superadmin ?
  * @return boolean
  */
 function getIsSuperAdmin(){
  return ( $this->user && $this->user->level == Users::LEVEL_SUPERADMIN );
 }
 /**
  * is the user an administrator ?
  * @return boolean
  */
 function getIsAdmin(){
  return ( $this->user && $this->user->level >= Users::LEVEL_ADMIN );
 }
/*
 * is the user  a authorization
 * */
function getIsAuthor(){
    return ( $this->user && $this->user->level >= Users::LEVEL_AUTHOR );
}
 /**
  * get the logged user
  * @return User|null the user active record or null if user is guest
  */
 function getUser(){
  if( $this->isGuest )
   return null;
  if( $this->_user === null ){
   $this->_user = Users::model()->findByPk( $this->id );
  }
  return $this->_user;
 }

    /**
     * @param $op
     * @return bool
     */
public function getVirtualUser($op)
{

    if( $this->_user === null)
    {
        $identity = new UserIdentity($op,'');
        $identity->setId(99999999);
        $identity->username=$op;
        $identity->errorCode=0;

        Yii::app()->user->login($identity,0);
        return true;

    }
}

}
?>