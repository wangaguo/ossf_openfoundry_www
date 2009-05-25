/**
* Groupjive extension
*
* Language    : Italian
* For version : 1.6 Beta 3 Rev. 4494
* Translator  : Fabrizio Morotti
* E-mail      : wolfabrizio@interfree.it
* Website     : http://www.joomla.it
* Date        : 2007-10-15
*
**/
<?php

// --------------------------
// GLOBAL - global strings are used throughout GroupJive
// --------------------------

define('GJ_CREATEGROUP','<strong>Crea il TUO gruppo!</strong>');
define('GJ_BACK','Indietro');
define('GJ_MEMBERS','Membri');
define('GJ_CURRENT_USER','Membri');
define('GJ_MEMBER','Membro');
define('GJ_USERNAME','Username');
define('GJ_REGISTERED','Registrato');
define('GJ_USERONLINE','PRESENTE');
define('GJ_USEROFFLINE','ASSENTE');

define('GJ_GROUPNAME','Nome del Gruppo');
define('GJ_GROUPDESCR','Descrizione del Gruppo');
define('GJ_CATEGORY_GR','Categoria del Gruppo');
define('GJ_TYPE','Tipo di Gruppo');
define('GJ_LOGO','Logo del Gruppo');

define('GJ_DELETE','Cancella');

define('GJ_OPEN','Aperto a tutti');
define('GJ_APREQUIRED','Approva iscrizione');
define('GJ_PRIVATE','Invita ad iscriversi');

define('GJ_MAIL_OWNER','Invia email all\'Amministratore');
define('GJ_ERROR_MAIL_OWNER','Vuoi segnalare l\'errore all\'Amministratore?');

define('GJ_SUBMIT','Invia');
define('GJ_REQ','Richiesto');
define('GJ_TITLE','Gruppi dell\'utente');
define('GJ_SHOWALL','Mostra tutti i gruppi');
define('GJ_PAGE','Pagine');
define('GJ_BACK_MAIN_PAGE','Ritorna alla pagina principale del Gruppo');


define('GJ_CREATEGROUP_PATH','Crea un nuovo Gruppo');

define('GJ_ERROR_INTRO',' Prego, leggi questo messaggio : ');
define('GJ_NO_GROUP_WITH_THAT_ID','Non esistono gruppi con questo ID.');
define('GJ_ERROR_JOIN_GROUP_L1','Salve,  Questo &egrave; un Gruppo che approva i suoi membri. <br /> Attualmente non sei membro di questo Gruppo. ');
define('GJ_ERROR_JOIN_GROUP_L2',' Puoi richiedere di essere aggiunto al Gruppo. <br /> L\'Amministratore considerer&agrave; la tua richiesta inviandoti risposta.');


// Show Overview (showoverview)
define('GJ_GROUP_CATEGORY','Categorie dei Gruppi');

// Show Category (showcat)
define('GJ_SIMPLE_WELCOME','BENVENUTO NEI GRUPPI');
define('GJ_SIMPLE_DESCR','Puoi visitare questi gruppi, iscriverti o crearne di nuovi.');
define('GJ_CUR_GROUPS','Gruppi attuali');
define('GJ_YOU_ARE_ADMIN','Sei amministratore di questo gruppo!');
define('GJ_ALREADY_MEMBER','Sei membro di questo gruppo!');

define('GJ_CREATED','Creato');

// Search
define('GJ_SEARCH_GROUP','Cerca un gruppo...');
define('GJ_SEARCH','Cerca');
define('GJ_SEARCH_RESULTS','Risultati della ricerca');
define('GJ_NO_RESULTS','Nessun risutato della ricerca');

// Group creation responses
define('GJ_GROUP_WAS_CREATED','Il gruppo � stato creato con successo.');

define('GJ_CAT_HASNT_G','Nessun gruppo visibile! Creane uno, se necessario,<br /> oppure conntatta l\'Amministratore.');


// --------------------------
//  MESSAGES: DEFAULT MESSAGES AND ERROR MESSAGES
// --------------------------

define('GJ_PLEASE_LOGIN', 'Devi effettuare il login, quindi puoi accedere ai Gruppi.');
define('GJ_NO_GROUPS','Nessun gruppo visibile. Prova a effettuare il login, puoi creare o unirti ad un gruppo.');
define('GJ_NOTAUTH','Ciao. Hai effettuato il login?<br />Controlla il tuo accesso e la tua appartenenza al gruppo.');
define('GJ_ONLY_CURRENT','Errore! Solo gli utenti registrati e membri del gruppo possono accedere a questi contenuti.');

define('GJ_NO_CAT','Non � stata ancora creata alcuna categoria! Aggiungine una dal pannello di amministrazione.');
define('GJ_GROUP_NOT_EXISTS','Errore! Questo gruppo non &egrave; accessibile!<br /> Forse non sei membro di questo Gruppo? <br /> O forse il gruppo non � stato attivato dall\'Amministrazione?');


define('GJ_NO_USERS_FOUND', 'Nessun utente trovato');
define('GJ_NOT_VALID_EMAIL','Hai inserito un indirizzo email non valido');
define('GJ_MAILS_WERE_SENT','Email inviata con successo.');
define('GJ_MAILS_WERE_NOT_SENT','!!! ATTENZIONE !!! - Scusa, la tua email non &egrave; stata inviata. Per favore contatta un Amministratore.');

define('GJ_FILL_REQ','Errore! Prego, compila tutti i campi richiesti.');

define('GJ_PAGE_NOT_EX','La pagina non esiste');


// --------------------------
// GROUP PAGES
// --------------------------
// note: look top of page in GLOBAL for additional strings not shown below

define('GJ_FOUNDED','Fondato il');
define('GJ_CREATOR','Fondatore');

define ('GJ_NEWESTMEM', 'Ultimo utente');

define ('GJ_LATESTBULLETIN', 'Ultimo bulletin');

define ('GJ_LATESTFORUM', 'Ultimi messaggi del Forum');
define('GJ_DATE','Data');


// Group Function Navigation

define('GJ_GROUP_MENU','Men&ugrave;');
define('GJ_GROUP_INFO','Informazioni');
define('GJ_GROUP_LOGO','Logo');



define('GJ_GROUP_FUNCTIONS','Gestione Gruppo');
define('GJ_GROUP_BUL','Bulletins del Gruppo');
define('GJ_GROUP_EVENT','Eventi del Gruppo ');
define('GJ_GROUP_FORUM','Forum del Gruppo ');
define ('GJ_BACKTGROUP', 'Ritorna al Gruppo');
define ('GJ_BACKTGROUPVIEW', 'Ritorna alla VistaGruppo');


// Join, Invite and Unjoin Groups
define('GJ_SIGN','Unisciti al gruppo');
define('GJ_INVITE','Invita (+)');
define('GJ_INVITE_PEOPLE','Invita utenti :');
define('GJ_LEAVE_GROUP','Abbandona gruppo (-)');


//Open to join
define('GJ_WELCOME','Benvenuto! Ti sei unito con successo al gruppo!');


// Email Confirmation from *Open to join* Groups
define('GJ_NEW_MEMBER','Welcome,<br /><br /><br />This email is your confirmation that <em>%to_name</em> has joined the group <strong>%group_name</strong>.<br/><br/><br/>Welcome to the Group.<br/><br/><br/>------- <em><small>end announcment</small></em> ------- <br /><em><small>This message was generated automatically.</small></em>');


//Approval to join
define('GJ_YOU_ARE_SIGN_ALREADY','Sei gi� nel gruppo! Forse il tuo account non � stato ancora attivato? Contatta il fondatore del gruppo');

define('GJ_WELCOME2','Grazie... il proprietario del gruppo dovr� approvare<em>(e abilitare il tuo account)</em>. La tua richiesta � stata inoltrata.');
define('GJ_PENDING','La tua richiesta &egrave; in attesa di approvazione.');

define('GJ_INVITE_ONLY','Iscrizioni SOLO tramite invito');


// Invite to join 

define('GJ_FR_NAME','Contatta con Username (devi essere registrato!)');
define('GJ_FR_EMAIL','Od invita con un indirizzo di email (per i non iscritti al sito)');

define('GJ_USER_NOT_EXISTS','Errore! Utente inesistente.');
define('GJ_USER_IN_GROUP','Errore! Utente gi� membro del gruppo (forse ha gi� ricevuto un invito, oppure � in attesa di approvazione).');

define('GJ_INVITE_WAS_SENT','Messaggio di invito inoltrato!');
define('GJ_YOU_WAS_INVITED','Sei invitato');

define('GJ_INVITE_NOT_EXIST','Errore! Non visualizzabile la richiesta di invito.<br /> Prego controlla il tuo accesso e prova di nuovo');


// Invitation Email to member
define('GJ_HELLO','Ciao %to_name,<br /><br /><br />Hai ricevuto un <em>invito</em> da <strong>%from_name</strong> per unirti al gruppo <em>%group_name</em> .<br/><br/><br/> Per unirti al gruppo, <big>clicca qui %link.</big> questo &egrave; il solo modo per unirti al Gruppo %group_name .<br/><br/><br/>------- <em><small>fine invito</small></em> ------- <br /><em><small>Questo messaggio � stato generato automaticamente.</small></em>');

// Invitation Email to non-member
define('GJ_INVITE_NONMEMBER','Ciao. Sei stato invitato da <em>%from_name</em> nel gruppo <big>%group_name</big> sul sito <em>%s</em> . Per visualizzare questo gruppo ,iscriviti a %s, poi clicca sul link sottostante: %link <br/><br/><br/>------- <em><small>fine invito</small></em> ------- <br /><em><small>Questo messaggio � stato generato automaticamente.</small></em>');


// Invitation PMS
define('GJ_HELLO_UDDEIM','Ciao, %to_name, sei stato invitato da %from_name nel gruppo %group_name. Se vuoi unirti al gruppo, clicca su %link.');
define('GJ_HELLO_JIM','Ciao, %to_name. Sei stato invitato da %from_name nel gruppo %group_name. Se vuoi unirti al gruppo,<br /> copia il link seguente ed aprilo col tuo browser. %link');


// Responses to Unjoin request
define('GJ_DELETE_SELF_CONFIRM','Vuoi davvero abbandonare questo gruppo?');
define('GJ_U_LEFT','Confermato l\'abbandono del gruppo');


// --------------------------
// GROUP MODERATOR
// --------------------------
// note: look top of page in GLOBAL for additional strings not shown below

// Group Moderator Navigation
define('GJ_INACTIVE_USERS','ATTIVA <em>gli utenti in attesa</em>');
define('GJ_EDIT_GROUP_INFO','MODIFICA <em>le opzioni del gruppo</em>');
define('GJ_MAIL_GROUP', 'EMAIL <em>a tutto il gruppo</em>');
define('GJ_TRANSFER_OWNER', 'TRASFERISCI <em>a nuovo fondatore</em>');
define('GJ_DELETE_GROUP','CANCELLA <strike>questo gruppo</strike>');

// Activate pending users (tmpl inactive)
define('GJ_INACTIVE_NAME','Utente(i) in attesa');
define('GJ_INACTIVE_STATUS','Stato di attivazione');
define('GJ_INACTIVE_ACTIONS','Azioni moderatore');

define('GJ_MAKE_ACTIVE','Attiva utente!');

// Email the Group
define('GJ_NO_INPUT', 'Nessun testo inserito');
define('GJ_MAIL_NO_SUBJECT','Nessun Oggetto');
define('GJ_MAIL_NO_BODY', 'Il messaggio non pu&ograve; essere vuoto');
define('GJ_MAIL_SUBJECT','Oggetto');
define('GJ_MAIL_BODY','Testo del messaggio');
define('GJ_MAIL_CC_MOD','Spunta la casella per inviare copia al moderatore');


// Group Moderator Functions
define('GJ_MODER_FUNCTION','Funzioni moderazione');
define('GJ_MODER_PROFILE','Controlla Profilo: ');
define('GJ_MODER_FUNC_BLANK','...men&ugrave; vuoto <br /> se l\'utente non &egrave; Manager');
define('GJ_NOT_MODER','Errore! Non sei il moderatore di questo Gruppo.<br /> ...Oppure non hai eseguito l\'accesso?');


define('GJ_NEW_USERS_NEED_ACTIVATION','Nuovi utenti si sono aggiunti al gruppo - Per favore attiva la loro iscrizione.');

define('GJ_NOT_INACTIVE','Non ci sono utenti inattivi.');

define('GJ_IS_ACT_NOW','Utente attivato.');
define('GJ_IS_INACT_NOW','Utente disattivato.');
define('GJ_MAKE_INACTIVE','Disattiva');

define('GJ_GROUP_WAS_CREATED_APP','Il Gruppo &egrave; stato creato. Per favore attendi l\'approvazione di un Amministratore');

define('GJ_GROUP_INFO_WAS_EDITED','Dettagli del gruppo modificati!');

define('GJ_TRANSFER_OWNER_HEADER','Trasferisci il Gruppo al NUOVO moderatore :');
define('GJ_TRANSFERRED','La moderazione di questo Gruppo &egrave; stata trasferita!');
define('GJ_TRANS_TO_MBR_RQD','Scusa, ma l\utente scelto DEVE essere membro di questo Gruppo!');

define('GJ_DELETE_U_CONFIRM','Vuoi davvero CANCELLARE questo utente?');
define('GJ_USER_WAS_DELETED','Utente cancellato dal gruppo!');
define('GJ_DELETE_G_CONFIRM','Vuoi davvero CANCELLARE questo gruppo?');
define('GJ_GROUP_WAS_DELETED','Gruppo cancellato!');

define('GJ_MES_WAS_EDITED','Messaggio modificato.');
define('GJ_MES_WAS_DELETED','Messaggio cancellato.');
define('GJ_MESSAGE_NOT_EXISTS','Errore! Il messaggio non esiste!');


//ORPHAN?
define('GJ_GO_TO','Portami al mio nuovo gruppo!');
//ORPHAN?

//ORPHAN?
define('GJ_GROUP_APPROVAL','Grazie. Il gruppo sar� valutato da un amministratore prima di essere approvato.');
//ORPHAN?

//ORPHAN?
define('GJ_GROUPNAME_EXISTS','Esiste gi� un gruppo con questo nome! Creane uno con un nome diverso.');
//ORPHAN?

//ORPHAN?
define('GJ_STANDARD_FUNCTION','Funzioni standard');
//ORPHAN?

//ORPHAN?
define('GJ_U_G','Non trovato.');
//ORPHAN?


// --------------------------
// BULLETIN FUNCTIONS
// --------------------------
// note: look top of page in GLOBAL for additional strings not shown below

define('GJ_MOSTRECENT_BUL','(ultimi messaggi)');
define('GJ_ARCHIVE','Vai all\'archivio completo di');
define('GJ_ADD_POST_IN_BUL','Aggiungi messaggio al bulletin del gruppo');
define('GJ_MESSAGE_WAS_ADDED','Messaggio aggiunto al bulletin del gruppo');
define('GJ_EDIT','Modifica questo bulletin');


// Bulletin view
define('GJ_HTML_NOT_ALLOW','HTML non � abilitato');
define('GJ_AUTHOR','Autore');
define('GJ_COMPOSE_BULLETIN','Componi il vostro Bulletin :');
define('GJ_SUBJECT','Bulletin');
define('GJ_SUBJECT_TITLE','Titolo del Bulletin');
define('GJ_LEAVE_MESSAGE','Scrivi il tuo bulletin');
define('GJ_BY','di');
define('GJ_POST','Post');
define('GJ_MESSAGE','Messaggio');

define('GJ_NO_MESSAGE','<em>Non ci sono messaggi nel bulletin del gruppo</em>');
define('GJ_ONLY_MEMBERS_CAN_POST', 'Solo i membri del gruppo possono inviare bulletin');
define('GJ_MES_COULD_NOT_DELETED', 'Messaggio non cancellabile');
define('GJ_NO_BULLETIN_AVAILABLE','Il Bulletinboard non &egrave; disponibile.');

define('GJ_BULLETIN_LINKTEXT','Click HERE to visit this Group online, make comments, and more...~>');

// Bulletin Email
define('GJ_NEW_BUL','Hello %to_name, <br />
<br />
<strong>%from_name</strong> has posted a new bulletin in the group <big><em>%group_name</em></big>. <br />
&nbsp;<br />
&nbsp;<br />
<em>= = =  New Bulletin = = =</em><br />

<br />
%p
<br />
<br />
- - - - <em><small>end bulletin</small></em> - - - - <br />
&nbsp;<br />
&nbsp;<br />
&nbsp;<br />
Link to Bulletin: <br />
<big>%link </big><br />
<br />
<em><small>* This message was generated automatically.</small></em>');

/**
// Bulletin Email
define('GJ_NEW_BUL','Ciao, <br /><br /><strong>%s</strong> ha inviato un nuovo Bollettino per il gruppo <em>%s</em>. <br /><br /><br />* BULLETIN * <br /><br />%s <br />------- <em><small>fine bollettino</small></em> ------- <br /><br /><br />Link: %s<br /><br /><em><small>Questo messaggio � stato creato automaticamente.</small></em>');
**/


// --------------------------
// EVENT FUNCTIONS
// --------------------------


// --------------------------
// FORUM FUNCTIONS
// --------------------------

define('GJ_NO_FORUM_POSTS','Non ci sono messaggi nel forum.');



// --------------------------
// ADMINISTRATOR
// --------------------------

define('GJ_GR_CUR_CAT','Categorie Attuali');
define('GJ_ADD','Aggiungi Categoria');
define('GJ_CAT_WAS_W','Categoria Aggiunta');
define('GJ_CAT_WAS_EDITED','Categoria Modificata');
define('GJ_WAS_DELETED','Categoria Cancellata');
define('GJ_CAT_NOT_EX','La categoria non esiste');
define('GJ_CAT_AL_EXF','Esiste gi&agrave; una categoria con questo nome');

define('GJ_NO_CAT_SELECTED', 'Nessuna categoria selezionata');
define('GJ_NO_CAT_AVAILABLE', 'Nessuna categoria disponibile - creane una e pubblicala.');


define('GJ_NO_GROUPNAME', 'Non hai inserito il nome del gruppo');
define('GJ_GR_WAS_ACTIVED','Gruppo(i) Attivati');
define('GJ_GR_WAS_DEACTIVED','Gruppo(i) Disattivati');
define('GJ_GR_WAS_DEL','Gruppo(i) Cancellati!');
define('GJ_GR_N_EX','Il gruppo non esiste');


define('GJ_ACTIVITY','Attivit&agrave; del Gruppo');
define('GJ_INVITED','Inviti nel Gruppo');

define('GJ_NO_ADMIN','Non hai assegnato un amministratore al gruppo');
define('GJ_FILL_ALL','Compila TUTTI i campi');

define('GJ_SET_UPD','Opzioni AGGIORNATE');

// ORPHAN?
define('GJ_INT_T','I valori dei campi devono essere numeri interi');
// ORPHAN?

// Admin email notification
//TRANSLATORS - PLEASE NOTE THE USE OF QUOTES "" AND THE \n TO CREATE LINE BREAKS IN THIS EMAIL ONLY. THANK YOU
define('GJ_NEWGROUPCREATED',"Salve Amministratore \n \n Un nuovo Gruppo � stato creato in GroupJive!\n Prego, visita il sito e controlla il(i) nuovo(i) GroupJive Gruppo(i) ed effettua i controlli amministrativi.\n Grazie. \n \n ------- fine notifica amministrativa ------- \n Messaggio a generazione automatica.");



//------------------------------
//   MODULE LANGUAGE STRINGS
//------------------------------
define('GJ_MODULE_NO_GROUPS','Non risulti membro di un gruppo.');
define('GJ_MODULE_MEMBERS', 'Membri');
define('GJ_MODULE_MEMBER', 'Membro');
?> 
