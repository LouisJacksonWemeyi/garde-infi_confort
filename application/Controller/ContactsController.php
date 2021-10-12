<?php
/**
 * Created by PhpStorm.
 * User: tim
 * Date: 19/09/17
 * Time: 14:46
 */

namespace Mini\Controller;


use Mini\Model\Contact;

class ContactsController
{
    public function addContact()
    {

        $contact = new Contact();

        $contactId = $contact->addContact($_POST);

        echo $contactId;
    }

    public function addClientContact() {
        $contact = new Contact();

        $contact_id = $contact->addContact($_POST);

        echo $contact->addClientContact($_POST['client_id'], $contact_id);

    }

    public function updateContact() {
        $contact = new Contact();

        echo $contact->updateContact($_POST);
    }

    /**
     * Supprime le contact de la table clients_has_personnes_contact et ensuite de la table personnes_contact
     */
    public function deleteContact()
    {
        $contact = new Contact();

        $ccOk = $contact->deleteClientContact($_POST['client'], $_POST['contact']);
        $contactOk = $contact->deleteContact($_POST['contact']);

        if ($contactOk && $ccOk) {
            echo true;
        } else echo false;
    }

}