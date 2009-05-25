<?php

// --------------------------
// GLOBAL - global strings are used throughout GroupJive
// --------------------------

define('GJ_CREATEGROUP','<strong>�Crea tu PROPIO grupo!</strong>');
define('GJ_BACK','<~ Regresar');


/* please not usage of Member and Group Members is for singular and/or plural instances when needed. */
define('GJ_MEMBER','Miembro');
define('GJ_MEMBERS','Miembros del Grupo');
define('GJ_CURRENT_USER','Miembros Actuales');

define('GJ_USERNAME','Nombre de usuario');
define('GJ_REGISTERED','Presencia en l�nea');
define('GJ_USERONLINE','ONLINE');
define('GJ_USEROFFLINE','OFFLINE');

define('GJ_GROUPNAME','Nombre del grupo');
define('GJ_GROUPDESCR','Acerca del grupo');
define('GJ_CATEGORY_GR','Categor�a del grupo');
define('GJ_TYPE','Tipo de grupo');
define('GJ_LOGO','Logo del grupo');

define('GJ_DELETE','Eliminar');

define('GJ_OPEN','Abierto al p�blico');
define('GJ_APREQUIRED','Aprobaci�n necesaria');
define('GJ_PRIVATE','Solo por invitaci�n');

define('GJ_MAIL_OWNER','Email a l�der de grupo');
define('GJ_ERROR_MAIL_OWNER','�Enviar email a l�der de grupo?');

define('GJ_SUBMIT','Enviar');
define('GJ_REQ','Requerido');
define('GJ_TITLE','Grupos de usuario');
define('GJ_SHOWALL','Mostrar todos los grupos existentes');
define('GJ_PAGE','P�ginas');
define('GJ_BACK_MAIN_PAGE','Volver a la p�gina de grupo');


define('GJ_CREATEGROUP_PATH','Crear nuevo grupo');

define('GJ_ERROR_INTRO',' Por favor revisa este mensaje : ');
define('GJ_NO_GROUP_WITH_THAT_ID','No se encontr� ning�n grupo.');
define('GJ_ERROR_JOIN_GROUP_L1','Hola,  para ingresar a este grupo requieres aprobaci�n. <br /> A�n no eres un miembro de este grupo. ');
define('GJ_ERROR_JOIN_GROUP_L2',' Puedes solicitar tu ingreso al grupo. <br /> El l�der de grupo revisar� tu solicitud y responder�.');


// Show Overview (showoverview)
define('GJ_GROUP_CATEGORY','Categor�as de Grupo en la Comunidad');

// Show Category (showcat)
define('GJ_SIMPLE_WELCOME','BIENVENIDO AL SISTEMA DE ADMINISTRACI�N DE GRUPOS');
define('GJ_SIMPLE_DESCR','Puedes visitar grupos, unirte a grupos o crear tu propio grupo.');
define('GJ_CUR_GROUPS','Personas Online de los Grupos');
define('GJ_YOU_ARE_ADMIN','�Eres el l�der de este grupo!');
define('GJ_ALREADY_MEMBER','�Eres miembro de este grupo!');

define('GJ_CREATED','Creado');

// Search
define('GJ_SEARCH_GROUP','Busca un grupo...');
define('GJ_SEARCH','Buscar');
define('GJ_SEARCH_RESULTS','Aqu� est�n algunos resultados');
define('GJ_NO_RESULTS','No se han encontrado grupos con esas pal�bras que ingresaste');

// Group creation responses
define('GJ_GROUP_WAS_CREATED','El grupo se ha creado satisfactoriamente.');

define('GJ_CAT_HASNT_G','�No hay grupos visibles! Por favor crea un grupo si lo deseas <br />
o contacta a un administrador para que publique los grupos.');


// --------------------------
//  MESSAGES: DEFAULT MESSAGES AND ERROR MESSAGES
// --------------------------
define('GJ_PLEASE_LOGIN', 'El primer paso es registrarte, luego puedes reingresar a los Grupos.');
define('GJ_NO_GROUPS','No hay grupos visibles. Podr�as necesitar registrarte, crear o ingresar a un Grupo.');
define('GJ_NOTAUTH','Hola. �Ya te registraste e hiciste login?<br />Por favor revisa tu login y luego tu membres�a al grupo.');
define('GJ_ONLY_CURRENT','�Error! Solo los usuarios que han ingresado al sistema y que son miembros pueden acceder.');

define('GJ_NO_CAT','�A�n no se han creado categor�as! <br />Por favor agrega categor�as para tus grupos en el m�dulo de administraci�n.');
define('GJ_GROUP_NOT_EXISTS','�Error! El acceso a este grupo<br /> no est� disponible en este momento<br />
 �Ser� que no eres miembro del grupo? <br />... tal vez el grupo necesita activaci�n del administrador?<br /><br />
 <small><em>Los usuarios que acaban de aplicar para una membres�a de grupo pueden recibir este error  <br />hasta que el l�der de grupo responda la solicitud.</em></small>');


define('GJ_NO_USERS_FOUND', 'No se han encontrado usuarios');
define('GJ_NOT_VALID_EMAIL','No es una direcci�n email v�lida');
define('GJ_MAILS_WERE_SENT','El email se envi� satisfactoriamente.');
define('GJ_MAILS_WERE_NOT_SENT','��� Alert !!! - lo sentimos, tu email no pudo ser enviado. Por favor habla con un administrador.');

define('GJ_FILL_REQ','�Error! Por favor, diligencia todos los campos requeridos.');

define('GJ_PAGE_NOT_EX','La p�gina no existe');


// --------------------------
// GROUP PAGES
// --------------------------
// note: look top of page in GLOBAL for additional strings not shown below

define('GJ_FOUNDED','Fundado');
define('GJ_CREATOR','L�der');

define ('GJ_NEWESTMEM', 'Nuevos miembros');

define ('GJ_LATESTBULLETIN', '�ltima cartelera');

define ('GJ_LATESTFORUM', '�ltimo en foros');
define('GJ_DATE','Fecha');


// Group Function Navigation

define('GJ_GROUP_MENU','Men�');
define('GJ_GROUP_INFO','Info');
define('GJ_GROUP_LOGO','Logo');



define('GJ_GROUP_FUNCTIONS','Actividades de Grupo');
define('GJ_GROUP_BUL','Cartela de Grupo');
define('GJ_GROUP_EVENT','Eventos de Grupo');
define('GJ_GROUP_FORUM','Foro de Grupo');
define ('GJ_BACKTGROUP', 'Regresar el Grupo');
define ('GJ_BACKTGROUPVIEW', 'Regresar a la Vista de Grupo');


// Join, Invite and Unjoin Groups
define('GJ_SIGN','�nete a este Grupo');
define('GJ_INVITE','Invita personas (+)');
define('GJ_INVITE_PEOPLE','Invita a usuarios registrados :');
define('GJ_LEAVE_GROUP','Dejar grupo (-)');


//Open to join
define('GJ_WELCOME','�Bienvenido! Te has unido satisfactoriamente al grupo!');


// Email Confirmation to Users/Moderators about Users *JOINING* Groups
define('GJ_NEW_MEMBER','Hola %u,<br />
<br />
<br />
Este email es la confirmaci�n de que <em>%f</em> se ha unido al grupo <strong>%g</strong>.<br />
<br />
<br /><big>A todos los nuevos usuarios... �Buenvenidos al grupo!</big><br/>
<br />
<br />
<br />
Gracias y bienvenidos a la comunidad.<br />
<br />
<br />
<br />
&nbsp;<br />
<small>- POR FAVOR TOME EN CONSIDERACI�N:<br />
- Grupos ABIERTOS AL P�BLICO: Los usuarios pueden uniser a los grupos abiertos al p�blico e inmediatamente son miembros activos.<br />
- Grupos de APROBACI�N: Los usuarios aplican y se requiere de una aprobaci�n. El l�der de grupo responde a la solicitud y hace activaci�n de la membres�a, tan pronto le sea posible.<br />
- Gracias.</small><br />
<br />
- - - - - - <em><small>final del anuncio</small></em> - - - - - - <br />
<em><small>* Este mensaje se gener� autom�ticamente.</small></em>
');

//Approval to join
define('GJ_YOU_ARE_SIGN_ALREADY','�Ya eres miembro del grupo! �Tal vez tu cuenta no ha sido activada a�n? Contacta al l�der de grupo');

define('GJ_WELCOME2','Gracias... el l�der de grupo debe aprobar <em>(y permitir tu ingreso)</em>. Tu solicitud para unir el grupo ha sido enviada.');
define('GJ_PENDING','Tu solicitud est� pendiente de aprobaci�n.');

define('GJ_INVITE_ONLY','Membres�a dada solo por invitaci�n');


// Invite to join
define('GJ_FR_NAME','Contactar por nombre (�debe ser un usuario registrado!)');
define('GJ_FR_EMAIL','O invitar por direcci�n email (para personas que no son miembros de la comunidad)');

define('GJ_USER_NOT_EXISTS','�Error! El usuario no existe en el sistema.');
define('GJ_USER_IN_GROUP','�Error! El usuario ya es miembro del grupo (posiblemente ya fueron invitados, o depronto su cuenta a�n no ha sido activada).');

define('GJ_INVITE_WAS_SENT','�Se ha enviado la invitaci�n!');
define('GJ_YOU_WAS_INVITED','Est�s invitad@');

define('GJ_INVITE_NOT_EXIST','�Error! El registro de la invitaci�n no se puede ver. <br />
Por favor confirma que ingresaste al sistema e int�ntalo de nuevo.');


// Invitation Email to member
define('GJ_HELLO','Hola %u,<br />
<br />
<br />
Has recibido una invitaci�n para unirte al grupo de <em>%f</em>.
<br/>
<br/> Debes <em>dar clic en este link <big>%h.</big></em> si deseas activar tu membres�a e ingresar al grupo. El link es la �nica manera de activar tu membres�a. Si visitas el grupo (sin la activaci�n) debes regresar a este email y dar clic al link para realmente unirte al grupo.<br/>
<br/>
<br/><strong>%g</strong> es el grupo al que has sido invitad@. Dando clic al nombre del grupo permite que lo visites "SOLAMENTE" cuando el grupo est� *Abierto al p�blico*. El visitar el grupo no te une al mismo o activa tu membres�a.<br/>
<br/>
<br/>
------- <em><small>fin de la invitaci�n</small></em> ------- <br />
<em><small>Este mensaje fue generado autom�ticamente.</small></em>
');


// Invitation Email to non-member
define('GJ_INVITE_NONMEMBER','Hola,<br />
<br /> Este mensaje es una <strong>invitaci�n</strong>.
<br />
<br />
Has sido invitad@ por <em>%f</em> a unirte a un grupo.
<br />
<br />
Para visitar este grupo, por favor da clic en este link: <big>%g</big>. Por favor ten en cuenta que primero debes hacer <em> log in</em> antes de unirte a cualquier grupo al que has sido invitad@ 
<br />
<br />
Los grupos online comparten intereses en com�n como foros de di�logo, eventos de grupo, carteleras con mensajes y m�s. Puedes regresar y visitar %h en cualquier momento en la Web en %s .
<br />
<br />
Gracias.
<br />
<br />
<br />
------- <em><small>esta es una invitaci�n en l�nea</small></em> ------- <br />
<em><small>Este mensaje ha sido generado autom�ticamente.</small></em>
');


// Invitation PMS
define('GJ_HELLO_UDDEIM','Hola, %u, has sido invitad@ por %f en %g. Para unirte a este grupo, por favor visita %h.');
define('GJ_HELLO_JIM','Hola, %u. Has sido invitad@ por %f en %g. Si deseas unirte al grupo, por favor copia la siguiente direcci�n url y p�gala en la ventana de tu navegador Web.
 %h');


// Responses to Unjoin request
define('GJ_DELETE_SELF_CONFIRM','�Realmente deseas dejar este grupo?');
define('GJ_U_LEFT','<big><em>Has dejado el grupo satisfactoriamente</em></big>');



// --------------------------
// GROUP MODERATOR
// --------------------------
// note: look top of page in GLOBAL for additional strings not shown below

// Group Moderator Navigation
define('GJ_INACTIVE_USERS','ACTIVAR <em>usuarios pendientes</em>');
define('GJ_EDIT_GROUP_INFO','EDITAR <em>configuraci�n de grupo</em>');
define('GJ_MAIL_GROUP', 'EMAIL <em>para todos en el grupo</em>');
define('GJ_TRANSFER_OWNER', 'CAMBIAR <em>de l�der</em>');
define('GJ_DELETE_GROUP','ELIMINAR <strike>este grupo</strike>');

// Activate pending users (tmpl inactive)
define('GJ_INACTIVE_NAME','Usuario(s) pendientes');
define('GJ_INACTIVE_STATUS','Estado de Activaci�n');
define('GJ_INACTIVE_ACTIONS','Acciones del L�der');

define('GJ_MAKE_ACTIVE','�Activar Usuario!');

// Email the Group
define('GJ_NO_INPUT', 'No se ha ingresado mensaje');
define('GJ_MAIL_NO_SUBJECT','Sin asunto');
define('GJ_MAIL_NO_BODY', 'El mensaje no puede estar vac�o');
define('GJ_MAIL_SUBJECT','Asunto');
define('GJ_MAIL_BODY','Cuerpo del Mensaje');
define('GJ_MAIL_CC_MOD','Selecciona esta casilla si deseas enviar copia al l�der de grupo');


// Group Moderator Functions
define('GJ_MODER_FUNCTION','Funciones del L�der');
define('GJ_MODER_PROFILE','Perfil del L�der: ');
define('GJ_MODER_FUNC_BLANK','...este men� est� vacio <br /> si el usuario no es l�der');
define('GJ_NOT_MODER','�Error! No eres el l�der de este grupo.<br /> ...�o no has hecho login?');


define('GJ_NEW_USERS_NEED_ACTIVATION','Nuevos usuarios se han unido al grupo - por favor act�valos.');

define('GJ_NOT_INACTIVE','Todos los usuarios pendientes han sido activados.');

define('GJ_IS_ACT_NOW','El usuario est� activo.');
define('GJ_IS_INACT_NOW','El usuario est� inactivo.');
define('GJ_MAKE_INACTIVE','Inactivar');

define('GJ_GROUP_WAS_CREATED_APP','El grupo se creo satisfactoriamente. Por favor espera la aprobaci�n de un Administrador.');

define('GJ_GROUP_INFO_WAS_EDITED','�Los detalles del grupo han sido editados satisfactoriamente!');

define('GJ_TRANSFER_OWNER_HEADER','Cambiar a NUEVO l�der de grupo :');
define('GJ_TRANSFERRED','�El liderato del grupo ha sido transferido!');
define('GJ_TRANS_TO_MBR_RQD','Lo sentimos, el usuario debe ser miembro de este grupo');

define('GJ_DELETE_U_CONFIRM','Por favor confirma que deseas ELIMINAR a este usuario?');
define('GJ_USER_WAS_DELETED','El usuario se ha eliminado del grupo satisfactoriamente');
define('GJ_DELETE_G_CONFIRM','Por favor confirma que deseas ELIMINAR este grupo');
define('GJ_GROUP_WAS_DELETED','El grupo se ha eliminado satisfactoriamente');

define('GJ_MES_WAS_EDITED','La Cartelera se ha editado satisfactoriamente.');
define('GJ_MES_WAS_DELETED','La Cartelera se ha Eliminado.');
define('GJ_MESSAGE_NOT_EXISTS','�Error! Este Mensaje de Cartelera no existe, <br />... o ha sido eliminado');


//ORPHAN?
define('GJ_GO_TO','Llevame a mi nuevo grupo');
//ORPHAN?

//ORPHAN?
define('GJ_GROUP_APPROVAL','Gracias. El grupo ser� revisado por un administrador del portal para ser aprobado.');
//ORPHAN?

//ORPHAN?
define('GJ_GROUPNAME_EXISTS','Un grupo con ese nombre ya existe. ^pr favor crealo nuevamente usando otro nombre.');
//ORPHAN?

//ORPHAN?
define('GJ_STANDARD_FUNCTION','Funciones Est�ndar');
//ORPHAN?

//ORPHAN?
define('GJ_U_G','No se ha encontrado un resultado con ese usuario y grupo.');
//ORPHAN?


// --------------------------
// BULLETIN FUNCTIONS
// --------------------------
// note: look top of page in GLOBAL for additional strings not shown below

define('GJ_MOSTRECENT_BUL','(posteado recientemente)');
define('GJ_ARCHIVE','>> Ve al archivo completo de');
define('GJ_ADD_POST_IN_BUL','Agregar nuevo mensaje a la cartelera');
define('GJ_MESSAGE_WAS_ADDED','El mensaje se ha agregado satisfactoriamente en la cartelera');
define('GJ_EDIT','Editar este Mensaje de Cartelera');


// Bulletin view
define('GJ_HTML_NOT_ALLOW','<em>Contenido HTML no permitido</em>');
define('GJ_AUTHOR','Autor');
define('GJ_COMPOSE_BULLETIN','Compone tu Propio Mensaje :');
define('GJ_SUBJECT','Mensaje');
define('GJ_SUBJECT_TITLE','T�tulo');
define('GJ_LEAVE_MESSAGE','Escribe tu mensaje');
define('GJ_BY','por');
define('GJ_POST','Post');
define('GJ_MESSAGE','Mensaje');

define('GJ_NO_MESSAGE','<em>No hay mensajes en la cartelera de grupo</em>');
define('GJ_ONLY_MEMBERS_CAN_POST', 'Solo los miembros del grupo pueden ingresar mensajes a la cartelera.');
define('GJ_MES_COULD_NOT_DELETED', '�El mensaje no puede ser eliminado!');
define('GJ_NO_BULLETIN_AVAILABLE','La cartelera no est� disponible.');


define('GJ_BULLETIN_LINKTEXT','Da clic AQU� para ver todos los mensajes online, has comentarios, y m�s...~>');

// Bulletin Email
define('GJ_NEW_BUL','Hola %u, <br />
<br />
<strong>%f</strong> ha ingresado un nuevo mensaje a la cartelera de grupo <big><em>%g</em></big>. <br />
&nbsp;<br />
&nbsp;<br />
<em>= = =  Nuevo Mensaje = = =</em><br />

<br />
%p
<br />
<br />
- - - - <em><small>fin de mensaje</small></em> - - - - <br />
&nbsp;<br />
&nbsp;<br />
&nbsp;<br />
Link el Mensaje: <br />
<big>%h </big><br />
<br />
<em><small>* Este mensaje fue generado autom�ticamente.</small></em>');





// --------------------------
// EVENT FUNCTIONS
// --------------------------
define('GJ_LATEST_EVENTS','�ltimos Eventos');
define('GJ_NO_EVENTS','<em>No hay eventos a�n.</em>');
define('GJ_EVENTS_ONLY_FOR_MEMBERS', 'Estos eventos son para miembros solamente.');

// --------------------------
// FORUM FUNCTIONS
// --------------------------

define('GJ_NO_FORUM_POSTS','<em>No hay mensajes en el foro a�n.</em>');



// --------------------------
// ADMINISTRATOR
// --------------------------

define('GJ_GR_CUR_CAT','Categor�as Actuales');
define('GJ_ADD','Agregar Categor�a');
define('GJ_CAT_WAS_W','Categor�a agregada');
define('GJ_CAT_WAS_EDITED','Categor�a editada');
define('GJ_WAS_DELETED','Categor�a eliminada');
define('GJ_CAT_NOT_EX','La categor�a no existe');
define('GJ_CAT_AL_EXF','Una categor�a con ese nombre ya existe');

define('GJ_NO_CAT_SELECTED', 'No se ha seleccionado categor�a');
define('GJ_NO_CAT_AVAILABLE', 'No hay categor�a publicada disponible - por favor crea al menos una primero.');


define('GJ_NO_GROUPNAME', 'El nombre del grupo est� vac�o');
define('GJ_GR_WAS_ACTIVED','Grupo(s) activados');
define('GJ_GR_WAS_DEACTIVED','Grupo(s) baneados');
define('GJ_GR_WAS_DEL','Grupo(s) eliminados satisfactoriamente');
define('GJ_GR_N_EX','El grupo no existe');

define('GJ_ACTIVITY','Actividad de grupo');
define('GJ_INVITED','Invitaci�n de grupo');

define('GJ_NO_ADMIN','No se ha asignado un administrador');
define('GJ_FILL_ALL','Por favor diligencia todos los campos');

define('GJ_SET_UPD','Configuraci�n Actualizada');

// ORPHAN?
define('GJ_INT_T','Values of fields groups on page, messages on frontpage should be integer');
// ORPHAN?

// Admin email notification
//TRANSLATORS - PLEASE NOTE THE USE OF QUOTES "" AND THE \n TO CREATE LINE BREAKS IN THIS EMAIL ONLY. THANK YOU
define('GJ_NEWGROUPCREATED',"Hola Administrador de Grupos \n
\n
�Un nuevo grupo ha sido creado en GroupJive!\n
Por favor visita la p�gina Web para ver el nuevo grupo en GroupJive y completa cualquier labor administrativa necesaria.\n
Gracias.
\n
\n
------- fin de la notificaci�n a admin ------- \n
Este mensaje fue generado autom�ticamente.");



//------------------------------
//   MODULE LANGUAGE STRINGS
//------------------------------
define('GJ_MODULE_NO_GROUPS','A�n no eres miembro de ning�n grupo.');
define('GJ_MODULE_MEMBERS', 'Miembros');
define('GJ_MODULE_MEMBER', 'Miembro');
?>
