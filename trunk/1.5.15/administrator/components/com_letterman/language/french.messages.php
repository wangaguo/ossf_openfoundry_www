<?php
//french translation by dr.corbeille
define( "LM_SUBSCRIBE_SUBJECT", "Votre inscription � la lettre d'information de [mosConfig_live_site]" );
define( "LM_SUBSCRIBE_MESSAGE", 
"Bonjour [NAME],

Vous �tes inscrit � la lettre d'information de
[mosConfig_live_site].
Merci!

Pour valider votre inscription, merci de cliquer sur le lien ci-dessous ou de le copier
et de le coller dans votre navigateur.

[LINK]

_________________________
[mosConfig_live_site]" );

define( "LM_UNSUBSCRIBE_SUBJECT", "Lettre d'information de [mosConfig_live_site]: D�sinscription" );
define( "LM_UNSUBSCRIBE_MESSAGE", 
"Bonjour [NAME],

Vous n'�tes plus inscrit � la lettre d'information de [mosConfig_live_site].
Merci d'avoir utilis� nos services.

________________________
[mosConfig_live_site]" );

define( "LM_NEWSLETTER_FOOTER", 
"___________________________________________________________<br/>
Vous recevez cette lettre d'information car vous �tes inscrit<br/>
sur [mosConfig_live_site].<br/>
Pour annuler votre abonnement cliquez ici : [UNLINK]" );


/* Module */
define( "LM_FORM_NOEMAIL", "Veuillez saisir une adresse email correcte." );
define( "LM_FORM_SHORTERNAME", "Veuillez choisir un nom plus court." );
define( "LM_FORM_NONAME", "Veuillez entrer un nom de souscription" );
define( "LM_SUBSCRIBE", "Inscrire" );
define( "LM_UNSUBSCRIBE", "Annuler" );
define( "LM_BUTTON_SUBMIT", "Go!" );

/* Backend */
define( "LM_ERROR_NEWSLETTER_COULDNTBESENT", "La newsletter n�a pas pu �tre envoy�e!" );
define( "LM_NEWSLETTER_SENDTO_X_USERS", "La newsletter a �t� envoy�e � {X} utilisateurs" );
define( "LM_IMPORT_USERS", "Importer inscriptions " );
define( "LM_EXPORT_USERS", "Exporter inscriptions " );
define( "LM_UPLAOD_FAILED", "Echec du t�l�chargement" );
define( "LM_ERROR_PARSING_XML", "Erreur d�interpr�tation du fichier XML " );
define( "LM_ERROR_NO_XML", "Veuillez t�l�charger des fichiers XML uniquement" );
define( "LM_ERROR_EMAIL_ALREADY_ONLIST", "Cette adresse email est d�j� dans la liste" );
define( "LM_SUCCESS_ON_IMPORT", "{X} inscriptions import�es." );
define( "LM_IMPORT_FINISHED", "Importation accomplie");
define( "LM_ERROR_DELETING_FILE", "Echec de l�effacement de fichier" );
define( "LM_DIR_NOT_WRITABLE", "Echec d��criture vers ".$GLOBALS['mosConfig_cachepath'] );
define( "LM_ERROR_INVALID_EMAIL", "Adresse email non valide" );
define( "LM_ERROR_EMPTY_EMAIL", "Adresse mail vide" );
define( "LM_ERROR_EMPTY_FILE", "Erreur: Fichier vide" );
define( "LM_ERROR_ONLY_TEXT", "Texte uniquement" );

define( "LM_SELECT_FILE", "Veuillez s�lectionner un fichier" );
define( "LM_YOUR_XML_FILE", "Votre fichier XML YaNC/Letterman" );
define( "LM_YOUR_CSV_FILE", "Fichier d�importation CSV " );
define( "LM_POSITION_NAME", "Position de la colonne -Nom-" );
define( "LM_NAME_COL", "Colonne Nom" );
define( "LM_POSITION_EMAIL", "Position de la colonne -Email-" );
define( "LM_EMAIL_COL", "Colonne Email " );
define( "LM_STARTFROM", "D�marrer l�importation depuis la ligne..." );
define( "LM_STARTFROMLINE", "D�marrer depuis la ligne" );
define( "LM_CSV_DELIMITER", "Signe de d�limitation CSV" );
define( "LM_CSV_DELIMITER_TIP", " Signe de d�limitation CSV: , ; ou tabulateur" );

/* Newsletter Management */
define( "LM_NM", "Gestion de newsletter" );
define( "LM_MESSAGE", "Message" );
define( "LM_LAST_SENT", "Dernier envoi" );
define( "LM_SEND_NOW", "Envoyer maintenant" );
define( "LM_CHECKED_OUT", "Checked Out" );
define( "LM_NO_EXPIRY", "Fin: Pas d�expiration" );
define( "LM_WARNING_SEND_NEWSLETTER", "Etes-vous sur de vouloir envoyer la newsletter?\\nAttention: S�il y a beaucoup de destinataires, cela prendra du temps! " );
define( "LM_SEND_NEWSLETTER", "Envoyer la newsletter" );
define( "LM_SEND_TO_GROUP", "Envoyer � un groupe" );
define( "LM_MAIL_FROM", "Exp�diteur email" );
define( "LM_DISABLE_TIMEOUT", "Emp�cher timeout" );
define( "LM_DISABLE_TIMEOUT_TIP", "Cocher pour pr�venir une erreur de timeout.<br/><strong>Ne fonctionne pas en Safe Mode!</strong>" );
define( "LM_REPLY_TO", "R�pondre �" );
define( "LM_MSG_HTML", "Message (HTML-WYSIWYG)" );
define( "LM_MSG", "Message (HTML-source)" );
define( "LM_TEXT_MSG", "Message alternatif en mode texte" );
define( "LM_NEWSLETTER_ITEM", "Item de newsletter" );

/* Subscriber Management */
define( "LM_SUBSCRIBER", "Abonn�" );
define( "LM_NEW_SUBSCRIBER", "Nouvel abonn�" );
define( "LM_EDIT_SUBSCRIBER", "Editer abonn� " );
define( "LM_SELECT_SUBSCRIBER", "Choisir un abonn� " );
define( "LM_SUBSCRIBER_NAME", "Nom de l� abonn� " );
define( "LM_SUBSCRIBER_EMAIL", "Email de l� abonn� " );
define( "LM_SIGNUP_DATE", "Date d�inscription" );
define( "LM_CONFIRMED", "Confirm�" );
define( "LM_SUBSCRIBER_SAVED", "Les infos d�inscription ont �t� enregistr�es." );
define( "LM_SUBSCRIBERS_DELETED", "{X} abonn�s ont �t� supprim�s" );
define( "LM_SUBSCRIBER_DELETED", "L�abonn� a �t� supprim�." );

/* Frontend */
define( "LM_ALREADY_SUBSCRIBED", "Vous �tes d�j� abonn� � nos newsletters." );
define( "LM_NOT_SUBSCRIBED", "Vous n��tes actuellement PAS abonn� � nos newsletters." );
define( "LM_YOUR_DETAILS", "Vos d�tails:" );
define( "LM_SUBSCRIBE_TO", "Abonnez notre newsletter" );
define( "LM_UNSUBSCRIBE_FROM", "Annuler votre abonnement � la newsletter" );
define( "LM_VALID_EMAIL_PLEASE", "Veuillez entrer une adresse email valide");
define( "LM_SAME_EMAIL_TWICE", "Cette adresse est d�j� inscrite dans notre liste!" );
define( "LM_ERROR_SENDING_SUBSCRIBE", "Le message de confirmation n�a pas pu �tre envoy�:" );
define( "LM_SUCCESS_SUBSCRIBE", "Votre adresse a �t� ajout� � notre liste d�abonn�s." );
define( "LM_RETURN_TO_NL", "Retour � la page des newsletters" );
define( "LM_ERROR_UNSUBSCRIBE_OTHER_USER", "D�sol�, vous ne pouvez pas supprimer d�autres utilisateurs de la liste. " );
define( "LM_ERROR_SENDING_UNSUBSCRIBE", "Le message d�annulation n�a pas pu �tre envoy�:" );
define( "LM_SUCCESS_UNSUBSCRIBE", "Votre adresse email a �t� supprim� de notre liste." );
define( "LM_SUCCESS_CONFIRMATION", "Votre compte a �t� v�rifi� avec succ�s." );
define( "LM_ERROR_CONFIRM_ACC_NOTFOUND", "Le compte correspondant � votre lien d�activation n�a pas pu �tre trouv�" );

define( "LM_CONFIRMED_ACCOUNTS_ONLY", "Comptes confirm�s uniquement?" );
define( "LM_CONFIRMED_ACCOUNTS_ONLY_TIP", "Envoyer la newsletter uniquement aux comptes <strong>confirm�s</strong>. Les abonn�s n�ayant pas confirm� leur adresse ne recevront pas la newsletter. " );

define( "LM_NAME_TAG_USAGE", "Vous pouvez utiliser la balise <strong>[NAME]</strong> dans le contenu de la newsletter pour personnaliser celle-ci. [NAME] sera remplac� par le nom de l�abonn� lors de l�envoi." );

define( "LM_USERS_TO_SUBSCRIBERS", "Abonner les utilisateurs inscrits" );
define( "LM_ASSIGN_USERS", "Assigner utilisateurs" );

/**
 * @since Letterman 1.2.0
 */
define( 'LM_SEND_LOG', 'Letterman Newsletter Send Log' );
define( 'LM_NUMBER_OF_MAILS_SENT', '%s of %s mails have been sent so far.');
define( 'LM_SEND_NEXT_X_MAILS', 'Click the button to send the next %s Mails.');
define( 'LM_CHANGE_MAILS_PER_STEP', 'Change the mails-per-step amount');
define( 'LM_CONFIRM_ABORT_SENDING', 'Do you really want to abort sending this newsletter?');
define( 'LM_MAILS_PER_STEP', 'How many mails to send at once?');
define( 'LM_CONFIRM_UNSUBSCRIBE', 'Do you really want to unsusbcribe from our Newsletter service?');
/**
 * @since Letterman 1.2.1
 */
define( 'LM_COMPOSE_NEWSLETTER', 'Compose a newsletter from content items');
define( 'LM_USABLE_TAGS', 'Tags you can use' );
define( 'LM_CONTENT_ITEMS', 'Content items' );
define( 'LM_ADD_CONTENT', 'Add content items/articles' );
define( 'LM_ADD_CONTENT_TOOLTIP', 'If you select a content item from the list, a tag will be inserted into the textarea. This tag will be rendered to the full article (Into Text only with images) when clicking on Save.' );
define( 'LM_ATTACHMENTS', 'Attachments' );
define( 'LM_ATTACHMENTS_TOOLTIP', 'You can select one or multiple files from the directory %s, which will be embedded into the mail when sending. Please do not care about the [ATTACHMENT ..] tag - it will be removed when sending the newsletter!' );
define( 'LM_MULTISELECT', 'Multi-select files with Ctrl-MouseClick' );
?>