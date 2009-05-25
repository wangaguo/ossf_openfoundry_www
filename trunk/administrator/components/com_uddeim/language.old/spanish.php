<?php
// *******************************************************************
// Title          udde Instant Mensajes (uddeIM)
// Description    Instant Mensajes System for Mambo 4.5 / Joomla 1.0 / Joomla 1.5
// Author         � 2007-2008 Stephan Slabihoud, � 2006 Benjamin Zweifel
// License        This is free software and you may redistribute it under the GPL.
//                uddeIM comes with absolutely no warranty.
//                Use at your own risk. For details, see the license at
//                http://www.gnu.org/licenses/gpl.txt
//                Other licenses can be found in LICENSES folder.
// *******************************************************************
// Language file: Castellano (source file is Latin-1)
// Translator:     Jos� Chancosa Gimeno <noemail> 
// Translator:     Willieram 
// *******************************************************************

// New: 1.5
DEFINE ('_UDDEMODULE_ALLDAYS', ' mensajes');
DEFINE ('_UDDEMODULE_7DAYS', ' mensajes en los �ltimos 7 d�as');
DEFINE ('_UDDEMODULE_30DAYS', ' mensajes en los �ltimos 30 d�as');
DEFINE ('_UDDEMODULE_365DAYS', ' mensajes en los �ltimos 365 d�as');
DEFINE ('_UDDEADM_EMN_SENDERMAIL_WARNING', '<br /><b>Nota:<br />�Cuando se usa mosMail, se debe configurar una direcci�n de e-mail v�lida!!</b>');
DEFINE ('_UDDEIM_FILTEREDMESSAGE', 'mensaje filtrado');
DEFINE ('_UDDEIM_FILTEREDMESSAGES', 'mensajes filtrados');
DEFINE ('_UDDEIM_FILTER', 'Filtro:');
DEFINE ('_UDDEIM_FILTER_TITLE_INBOX', 'Mostrar de esta persona solamente');
DEFINE ('_UDDEIM_FILTER_TITLE_OUTBOX', 'Mostrar para esta persona solamente');
DEFINE ('_UDDEIM_FILTER_UNREAD_ONLY', 'solo no le�dos');
DEFINE ('_UDDEIM_FILTER_SUBMIT', 'Filtro');
DEFINE ('_UDDEIM_FILTER_ALL', '- todos -');
DEFINE ('_UDDEIM_FILTER_PUBLIC', '- usuarios p�blicos -');
DEFINE ('_UDDEADM_FILTER_HEAD', 'Habilitar Filtro');
DEFINE ('_UDDEADM_FILTER_EXP', 'Si los usuarios habilitados pueden filtrar su bandejas para mostrar s�lo un destinatario o receptor.');
DEFINE ('_UDDEADM_FILTER_P0', 'deshabilitado');
DEFINE ('_UDDEADM_FILTER_P1', 'arriba de la lista de mensajes');
DEFINE ('_UDDEADM_FILTER_P2', 'abajo de la lista de mensajes');
DEFINE ('_UDDEADM_FILTER_P3', 'arriba y abajo de la lista de mensajes');
DEFINE ('_UDDEIM_NOMESSAGES_FILTERED', '<b>No tienes mensajes %s en tu %s.</b>');	// see next also six lines
DEFINE ('_UDDEIM_NOMESSAGES_FILTERED_UNREAD', ' sin leer');
DEFINE ('_UDDEIM_NOMESSAGES_FILTERED_FROM', ' de esta persona');
DEFINE ('_UDDEIM_NOMESSAGES_FILTERED_TO', ' para esta persona');
DEFINE ('_UDDEIM_NOMESSAGES_FILTERED_INBOX', ' bandeja de entrada');
DEFINE ('_UDDEIM_NOMESSAGES_FILTERED_OUBOX', ' bandeja de salida');
DEFINE ('_UDDEIM_NOMESSAGES_FILTERED_ARCHIVE', ' archivo');
DEFINE ('_UDDEIM_TODP_TITLE', 'Destinatario');
DEFINE ('_UDDEIM_TODP_TITLE_CC', 'Uno o m�s destinatarios (separados por comas)');
DEFINE ('_UDDEIM_ADDCCINFO_TITLE', 'Cuando se marca, se agrega una l�nea al mensajee con todos los destinatarios.');
DEFINE ('_UDDEADM_CFGFILE_CONVERTING_2', '...opciones por omisi�n para autorespuesta, autoenv�o, cuadro de entrada, filtro');
DEFINE ('_UDDEADM_AUTORESPONDER_HEAD', 'Habilitar Autorespuesta');
DEFINE ('_UDDEADM_AUTORESPONDER_EXP', 'Cuando la autorespuesta est� habilitada, al usuario le aparece la opci�n de habilitar un mensaje de autorespuesta en sus opciones personales.');
DEFINE ('_UDDEIM_EMN_AUTORESPONDER', 'Habilitar Autorespuesta');
DEFINE ('_UDDEIM_AUTORESPONDER', 'Autorespuesta');
DEFINE ('_UDDEIM_AUTORESPONDER_EXP', 'Cuando la autorespuesta est� habilitada cada mensaje recibido se responde autom�ticamente.');
DEFINE ('_UDDEIM_AUTORESPONDER_DEFAULT', "Mis disculpas, pero ahora no  estoy disponible. Voy a leer los mensajes tan pronto como pueda.");
DEFINE ('_UDDEADM_USERSET_AUTOR', 'AutoR');
DEFINE ('_UDDEADM_USERSET_SELAUTOR', '- AutoR -');
DEFINE ('_UDDEIM_USERBLOCKED', 'Usuario bloqueado.');
DEFINE ('_UDDEADM_AUTOFORWARD_HEAD', 'Habilitar Autoenv�o');
DEFINE ('_UDDEADM_AUTOFORWARD_EXP', 'Cuando el autoenv�o est� habilitado, el usuario puede enviarse los nuevos mensajes a otro usuario autom�ticamente.');
DEFINE ('_UDDEIM_EMN_AUTOFORWARD', 'Habilitar Autoenv�o');
DEFINE ('_UDDEADM_USERSET_AUTOF', 'AutoF');
DEFINE ('_UDDEADM_USERSET_SELAUTOF', '- AutoF -');
DEFINE ('_UDDEIM_AUTOFORWARD', 'Autoenv�o');
DEFINE ('_UDDEIM_AUTOFORWARD_EXP', 'Los nuevos mensajes pueden enviarse a otro usuario autom�ticamente.');
DEFINE ('_UDDEIM_THISISAFORWARD', 'Autoenviar un menesaje originalmente enviado a ');
DEFINE ('_UDDEADM_COLSROWS_HEAD', 'Cuadro de Mensaje (cols/filas)');
DEFINE ('_UDDEADM_COLSROWS_EXP', 'Esto especifica las columnas y filas del cuadro donde se escriben los mensajes (normalmente es 60/10).');
DEFINE ('_UDDEADM_WIDTH_HEAD', 'Cuadro de mensaje (ancho)');
DEFINE ('_UDDEADM_WIDTH_EXP', 'Esto especifica el ancho del cuadro de mensajes en pixels (por omisi�n es 0). Si es 0, el ancho se toma de la hoja de estilos (CSS).');
DEFINE ('_UDDEADM_CBE', 'CB Potenciado');

// New: 1.4
DEFINE ('_UDDEADM_IMPORT_CAPS', 'IMPORTAR');

// New: 1.3
DEFINE ('_UDDEADM_MOOTOOLS_HEAD', 'Cargar MooTools');
DEFINE ('_UDDEADM_MOOTOOLS_EXP', 'Esto especifica c�mo uddeIM carga MooTools (MooTools se requiere para  el Autocompletador): <i>Ninguno</i> es �til cuando tu plantilla ya carga MooTools, <i>Auto</i> es lo recomendado  (el mismo comportamiento que en uddeIM 1.2), cuando se usa Joomla 1.0 tambi�n puedes forzar la carga de MooTools 1.1 o 1.2.');
DEFINE ('_UDDEADM_MOOTOOLS_NONE', 'no cargar MooTools');
DEFINE ('_UDDEADM_MOOTOOLS_AUTO', 'auto');
DEFINE ('_UDDEADM_MOOTOOLS_1', 'forzar carga de MooTools 1.1');
DEFINE ('_UDDEADM_MOOTOOLS_2', 'forzar carga de MooTools 1.2');
DEFINE ('_UDDEADM_CFGFILE_CONVERTING_1', '...confirguando valor por omisi�n para MooTools');
DEFINE ('_UDDEADM_AGORA', 'Agora');

// New: 1.2
DEFINE ('_UDDEADM_CRYPT3', 'Coficiaci�n Base64');
DEFINE ('_UDDEADM_TIMEZONE_HEAD', 'Ajustar zona horaria');
DEFINE ('_UDDEADM_TIMEZONE_EXP', 'Cuando uddeIM muestra mal el horario puedes ajustar la zona horaria aqu�. Usualmente, cuando todo se configura correctamente este valor debe ser 0, pero de todos modos puede haber casos raros donde necesites modificar este valor.');
DEFINE ('_UDDEADM_HOURS', 'horas');
DEFINE ('_UDDEADM_VERSIONCHECK', 'Informaci�n de la versi�n:');
DEFINE ('_UDDEADM_STATISTICS', 'Estad�sticas:');
DEFINE ('_UDDEADM_STATISTICS_HEAD', 'Mostrar estad�sticas');
DEFINE ('_UDDEADM_STATISTICS_EXP', 'Esto muestra algunas estad�sticas como el n�mero de mensajes almacenados, e tc.');
DEFINE ('_UDDEADM_STATISTICS_CHECK', 'MOSTRAR ESTAD�STICAS');
DEFINE ('_UDDEADM_MAINTENANCE_COUNT', 'Mensajes almancenados en la base de datos: ');
DEFINE ('_UDDEADM_MAINTENANCE_COUNT_RECIPIENT', 'Mensajes descartados  por el destinatario: ');
DEFINE ('_UDDEADM_MAINTENANCE_COUNT_SENDER', 'Mensajes descartados por el remitente: ');
DEFINE ('_UDDEADM_MAINTENANCE_COUNT_TRASH', 'Mensajes en espera para ser purgados: ');
DEFINE ('_UDDEADM_OVERWRITEITEMID_HEAD', 'Forzar Itemid');
DEFINE ('_UDDEADM_OVERWRITEITEMID_EXP', 'Usualmente uddeIM intenta detectar el Itemid correcto cuando no est� indicado. En algunos casos puede ser necesario forzar este valor, p. ej. cuando seusan varias entradas de men� a uddeIM.');
DEFINE ('_UDDEADM_OVERWRITEITEMID_CURRENT', 'Itemid detectado es: ');
DEFINE ('_UDDEADM_USEITEMID_HEAD', 'Usar Itemid');
DEFINE ('_UDDEADM_USEITEMID_EXP', 'Usear este Itemid en lugar del detectado.');
DEFINE ('_UDDEADM_SHOWLINK_HEAD', 'Usar v�culos al perfil');
DEFINE ('_UDDEADM_SHOWLINK_EXP', 'Cuando se elige <i>s�</i>, todos los usuarios que se muestran en uddeIM se mostrar�n como v�nculos  a su perfil de usuario.');
DEFINE ('_UDDEADM_SHOWPIC_HEAD', 'Mostrar miniaturas');
DEFINE ('_UDDEADM_SHOWPIC_EXP', 'When set to <i>yes</i>, la miniatura del usuario respectivo se muestra al leer un mensaje.');
DEFINE ('_UDDEADM_THUMBLISTS_HEAD', 'Mostrar miniaturas en listas');
DEFINE ('_UDDEADM_THUMBLISTS_EXP', 'Elegir <i>s�</i> si quieres mostrar las miniaturas de los usuarios en las listas de mensajes (bandejas de entrada, salida, etc.)');
DEFINE ('_UDDEADM_FIREBOARD', 'Fireboard');
DEFINE ('_UDDEADM_CB', 'Community Builder');
DEFINE ('_UDDEADM_DISABLED', 'Deshabilitado');
DEFINE ('_UDDEADM_ENABLED', 'Habilitado');
DEFINE ('_UDDEIM_STATUS_FLAGGED', 'Importante');
DEFINE ('_UDDEIM_STATUS_UNFLAGGED', '');
DEFINE ('_UDDEADM_ALLOWFLAGGED_HEAD', 'Permitir etiquetado de mensajes');
DEFINE ('_UDDEADM_ALLOWFLAGGED_EXP', 'Permite el etiquetado de mensajes (uddeIM muesetra una estrella en las listas de mensajes que se puede resaltar para marcar mensajes importantes).');
DEFINE ('_UDDEADM_REVIEWUPDATE', '�Importante: Cuando actualizas uddeIM desde una versi�n anterior, por favor revisar el README. Algunas veces debes agregar o cambiar tablas de la base de datos o campos!');
DEFINE ('_UDDEIM_ADDCCINFO', 'Agregar l�nea CC:');
DEFINE ('_UDDEIM_CC', 'CC:');
DEFINE ('_UDDEADM_TRUNCATE_HEAD', 'Truncar texto citado');
DEFINE ('_UDDEADM_TRUNCATE_EXP', 'Truncar el texto citado a 2/3 del largo maximo si excede el l�mite para mensajes.');
DEFINE ('_UDDEIM_PLUG_INBOXENTRIES', 'Entradas en la bandeja ');
DEFINE ('_UDDEIM_PLUG_LAST', '�ltimo ');
DEFINE ('_UDDEIM_PLUG_ENTRIES', ' entradas');
DEFINE ('_UDDEIM_PLUG_STATUS', 'Estado');
DEFINE ('_UDDEIM_PLUG_SENDER', 'Remitente');
DEFINE ('_UDDEIM_PLUG_MESSAGE', 'Mensaje');
DEFINE ('_UDDEIM_PLUG_EMPTYINBOX', 'Bandeja vac�a');

// New: 1.1
DEFINE ('_UDDEADM_NOTRASHACCESS_NOT', 'Acceso a la papelera no permitido.');
DEFINE ('_UDDEADM_NOTRASHACCESS_HEAD', 'Restringir el acceso a la papelera');
DEFINE ('_UDDEADM_NOTRASHACCESS_EXP', 'Puedes restringir el acceso a la papelera. Usualmente est� disponible para todos (<i>sin restricciones</i>). Puedes restringir el acceso a grupos especiales de usuarios o solo los administradores, para que los grupos de menores privilegios no puedan reciclar mensajes.');
DEFINE ('_UDDEADM_NOTRASHACCESS_0', 'sin restricciones');
DEFINE ('_UDDEADM_NOTRASHACCESS_1', 'usuarios especiales');
DEFINE ('_UDDEADM_NOTRASHACCESS_2', 's�lo admins');
DEFINE ('_UDDEADM_PUBHIDEUSERS_HEAD', 'Ocultar usuarios de la lista de usuarios');
DEFINE ('_UDDEADM_PUBHIDEUSERS_EXP', 'Ingresa la lista de IDs de usuario que quieres ocultar de la lista p�blica de usuarios (p.ej. 65,66,67).');
DEFINE ('_UDDEADM_HIDEUSERS_HEAD', 'Ocultar usuarios de la lista de usuarios');
DEFINE ('_UDDEADM_HIDEUSERS_EXP', 'Ingresa los IDs de usuario que quieres ocultar de la lista de usuarios (p.ej. 65,66,67). Los admins siempre ver�n la lista completa.');
DEFINE ('_UDDEIM_ERRORCSRF', 'Ataque CSRF reconocido');
DEFINE ('_UDDEADM_CSRFPROTECTION_HEAD', 'Protecci�n CSRF');
DEFINE ('_UDDEADM_CSRFPROTECTION_EXP', 'Esto protege de todas formas de ataque del tipo "Cross-Site Request Forgery". Usualmente esto deber�a estar habilitado. S�lo cuando tienes problemas extra�os lo deber�as apagar.');
DEFINE ('_UDDEIM_CANTREPLYARCHIVE', 'No puedes responder a mensajes archivados.');
DEFINE ('_UDDEIM_COULDNOTRECALLPUBLIC', 'Las repuestas a usuarios no registrados no pueden ser recuperadas.');
DEFINE ('_UDDEADM_PUBREPLYS_HEAD', 'Permitir respuestas');
DEFINE ('_UDDEADM_PUBREPLYS_EXP', 'Permitir respuestas directas a mensajes de los usuarios p�blicos.');
DEFINE ('_UDDEIM_EMN_BODY_PUBLICWITHMESSAGE',
"Hola %you%,\n\n%user% ha enviado el siguiente mensaje privado al sitio %site%.\n__________________\n%pmessage%");
DEFINE ('_UDDEADM_PUBNAMESTEXT', 'Mostrar nombres reales');
DEFINE ('_UDDEADM_PUBNAMESDESC', '�Mostrar nombres reales o de usuario en la Interfaz P�blica?');
DEFINE ('_UDDEIM_USERLIST', 'Lista de usuarios');
DEFINE ('_UDDEIM_YOUHAVETOWAIT', 'Lo sentimos, debes esperar para volver a enviar un nuevo mensaje');
DEFINE ('_UDDEADM_USERSET_LASTSENT', '�ltimo enviado');
DEFINE ('_UDDEADM_TIMEDELAY_HEAD', 'Retardo');
DEFINE ('_UDDEADM_TIMEDELAY_EXP', 'Tiempo en segundos que un usuario debe esperar antes de que pueda enviar un pr�ximo mensaje (0 es sin retardos).');
DEFINE ('_UDDEADM_SECONDS', 'segundos');
DEFINE ('_UDDEIM_PUBLICSENT', 'Mensaje enviado.');
DEFINE ('_UDDEIM_ERRORINFROMNAME', 'Error en el nombres del remitente');
DEFINE ('_UDDEIM_ERRORINEMAIL', 'Error en la direcci�n de email');
DEFINE ('_UDDEIM_YOURNAME', 'Tu nombre:');
DEFINE ('_UDDEIM_YOUREMAIL', 'Tu email:');
DEFINE ('_UDDEADM_VERSIONCHECK_USING', 'Est�s usando uddeIM ');
DEFINE ('_UDDEADM_VERSIONCHECK_LATEST', 'Ya est�s usando la �ltima versi�n de uddeIM.');
DEFINE ('_UDDEADM_VERSIONCHECK_CURRENT', 'La versi�n actual es ');
DEFINE ('_UDDEADM_VERSIONCHECK_INFO', 'Informaci�n de actualizaci�n:');
DEFINE ('_UDDEADM_VERSIONCHECK_HEAD', 'Buscar actualizaciones');
DEFINE ('_UDDEADM_VERSIONCHECK_EXP', 'Estos contacta al sitio de uddeIM para recibir informaci�n sobre la versi�n actual de uddeIM. Salvo la versi�n de uddeIM en uso, no se transmite otra informaci�n personal.');
DEFINE ('_UDDEADM_VERSIONCHECK_CHECK', 'BUSCAR AHORA');
DEFINE ('_UDDEADM_VERSIONCHECK_ERROR', 'No fue posible obtener la informaci�n de versi�n.');
DEFINE ('_UDDEIM_NOSUCHLIST', '�Lista de contactos no encontrada!');
DEFINE ('_UDDEIM_LISTSLIMIT_1', 'N�mero m�ximo de destinatarios excedido (max. ');
DEFINE ('_UDDEADM_MAXONLISTS_HEAD', 'M�x n�mero de entradas');
DEFINE ('_UDDEADM_MAXONLISTS_EXP', 'M�x n�mero de entradas permitidas por lista de contactos.');
DEFINE ('_UDDEIM_LISTSNOTENABLED', 'Las listas de contactos no est�n habilitadas');
DEFINE ('_UDDEADM_ENABLELISTS_HEAD', 'Habilitar listas de contactos');
DEFINE ('_UDDEADM_ENABLELISTS_EXP', 'uddeIM permite a los usuarios crear listas de contactos. Estas listas pueden usarse para enviar mensajes a m�ltiples personas. No olvides habilitar la opci�n de m�ltiples destinatarios cuando uses listas de contactos.');
DEFINE ('_UDDEADM_ENABLELISTS_0', 'deshabilitadas');
DEFINE ('_UDDEADM_ENABLELISTS_1', 'usuarios registrados');
DEFINE ('_UDDEADM_ENABLELISTS_2', 'usuarios especiales');
DEFINE ('_UDDEADM_ENABLELISTS_3', 'solamente admins');
DEFINE ('_UDDEIM_LISTSNEW', 'Crear nueva lista de contactos');
DEFINE ('_UDDEIM_LISTSSAVED', 'Lista de contactos grabada');
DEFINE ('_UDDEIM_LISTSUPDATED', 'Lista de contactos actualizada');
DEFINE ('_UDDEIM_LISTSDESC', 'Descripci�n');
DEFINE ('_UDDEIM_LISTSNAME', 'Nombre');
DEFINE ('_UDDEIM_LISTSNAMEWO', 'Nombre (sin espacios)');
DEFINE ('_UDDEIM_EDITLINK', 'editar');
DEFINE ('_UDDEIM_LISTS', 'Contactos');
DEFINE ('_UDDEIM_STATUS_READ', 'le�do');
DEFINE ('_UDDEIM_STATUS_UNREAD', 'sin leer');
DEFINE ('_UDDEIM_STATUS_ONLINE', 'online');
DEFINE ('_UDDEIM_STATUS_OFFLINE', 'offline');
DEFINE ('_UDDEADM_CBGALLERY_HEAD', 'Mostrar la galer�a de fotos de CB');
DEFINE ('_UDDEADM_CBGALLERY_EXP', 'Por omisi�n uddeIM muestra s�lo los avatars que los usuarios han subido. Si se habilita esta opci�n uddeIM tambi�n mostrar� fotos de la galer�a de avatars de CB.');
DEFINE ('_UDDEADM_UNBLOCKCB_HEAD', 'Desbloquear las conexiones de CB');
DEFINE ('_UDDEADM_UNBLOCKCB_EXP', 'Puedes permitir mensajes a destinatarios cuando el usuario registrado est� en la lista de conexiones de CB (incluso cuando el destinatario est� en un grupo bloqueado). Esto es independiente del bloqueo individual que cada usuario puede configurar cuando est� habilitado (ver opciones arriba).');
DEFINE ('_UDDEIM_GROUPBLOCKED', 'No est�s habilidatdo para enviar a este grupo.');
DEFINE ('_UDDEIM_ONEUSERBLOCKS', 'El recipiente te tiene bloqueado.');
DEFINE ('_UDDEADM_BLOCKGROUPS_HEAD', 'Grupos bloqueados (usuarios registrados)');
DEFINE ('_UDDEADM_BLOCKGROUPS_EXP', 'Grupos a los que los usuarios registrados no se les permite enviar enviar mensajes. Esto es para usuarios registrados solamente. Los usuarios especiales y los administradores no son afectados  por esta opci�n. Esta opci�n es independiente del bloqueo individual que cada usuario puede configurar cuando as� est� habilitado (ver opciones arriba).');
DEFINE ('_UDDEADM_PUBBLOCKGROUPS_HEAD', 'Grupos Bloqueados (usuarios p�blicos)');
DEFINE ('_UDDEADM_PUBBLOCKGROUPS_EXP', 'Grupos a los que los usuarios p�blicos no pueden enviarles mensajes. Esta opci�n es independiente del bloqueo individual que cada usuario puede configurar cuando as� est� habilitado (ver opciones arriba). Cuando bloqueas un grupo, los usuarios en el mismo no pueden ver la opci�n de habilitar la Interfaz P�blica del sitio en sus opciones de perfil.');
DEFINE ('_UDDEADM_BLOCKGROUPS_1', 'Usuario p�blico');
DEFINE ('_UDDEADM_BLOCKGROUPS_2', 'Conexi�n CB');
DEFINE ('_UDDEADM_BLOCKGROUPS_18', 'Usuario registrado');
DEFINE ('_UDDEADM_BLOCKGROUPS_19', 'Autor');
DEFINE ('_UDDEADM_BLOCKGROUPS_20', 'Editor');
DEFINE ('_UDDEADM_BLOCKGROUPS_21', 'Publicador');
DEFINE ('_UDDEADM_BLOCKGROUPS_23', 'Gerente');
DEFINE ('_UDDEADM_BLOCKGROUPS_24', 'Administrador');
DEFINE ('_UDDEADM_BLOCKGROUPS_25', 'SuperAdmin');
DEFINE ('_UDDEIM_NOPUBLICMSG', 'El usuario acepta s�lo mensajes de usuarios registrados.');
DEFINE ('_UDDEADM_PUBHIDEALLUSERS_HEAD', 'Ocultar al p�blico la lista "Todos"');
DEFINE ('_UDDEADM_PUBHIDEALLUSERS_EXP', 'Puedes ocultar ciertos grupos en la lista "Todos". Nota: esto oculta s�lo los nombres, los usuarios a�n pueden recibir mensajes. Los usuarios que no han habilitado la Interfaz P�blica nunca estar�n en esta lista.');
DEFINE ('_UDDEADM_HIDEALLUSERS_HEAD', 'Ocultar de la lista "Todos"');
DEFINE ('_UDDEADM_HIDEALLUSERS_EXP', 'Puedes ocultar ciertos grupos en la lista "Todos". Nota: esto oculta s�lo los nombres, los usuarios a�n pueden recibir mensajes.');
DEFINE ('_UDDEADM_HIDEALLUSERS_0', 'ninguno');
DEFINE ('_UDDEADM_HIDEALLUSERS_1', 's�lo superadmins');
DEFINE ('_UDDEADM_HIDEALLUSERS_2', 's�lo admins');
DEFINE ('_UDDEADM_HIDEALLUSERS_3', 'usuarios especiales');
DEFINE ('_UDDEADM_PUBLIC', 'P�blico');
DEFINE ('_UDDEADM_PUBMODESHOWALLUSERS_HEAD', 'Comportamiento del v�nculo "Todos"');
DEFINE ('_UDDEADM_PUBMODESHOWALLUSERS_EXP', 'Elija entre si el v�nculo "Todos" deber�a suprimirse en la Interfaz P�blica, deber�a mostrarse � si siempre todos los usuarios deber�an mostrarse.');
DEFINE ('_UDDEADM_USERSET_PUBLIC', 'Frente P�blico');
DEFINE ('_UDDEADM_USERSET_SELPUBLIC', '- seleccionar p�blico -');
DEFINE ('_UDDEIM_OPTIONS_F', 'Permitir que usuarios p�blicos env�en mensajes');
DEFINE ('_UDDEIM_MSGLIMITREACHED', '�L�mite de mensajes alcanzado!');
DEFINE ('_UDDEIM_PUBLICUSER', 'Usuario P�blico');
DEFINE ('_UDDEIM_DELETEDUSER', 'Usuario eliminado');
DEFINE ('_UDDEADM_CAPTCHALEN_HEAD', 'Longitud del Captcha');
DEFINE ('_UDDEADM_CAPTCHALEN_EXP', 'Especifica cu�ntos caracteres se deben ingresar.');
DEFINE ('_UDDEADM_USECAPTCHA_HEAD', 'Protecci�n Captcha contra spam');
DEFINE ('_UDDEADM_USECAPTCHA_EXP', 'Especifica qui�n tiene que ingresar un Captcha cuando se env�a un mensaje');
DEFINE ('_UDDEADM_CAPTCHAF0', 'deshabilitado');
DEFINE ('_UDDEADM_CAPTCHAF1', 's�lo usuarios p�blicos');
DEFINE ('_UDDEADM_CAPTCHAF2', 'usuarios p�blicos y registrados');
DEFINE ('_UDDEADM_CAPTCHAF3', 'usuarios p�blicos, registrados, especiales');
DEFINE ('_UDDEADM_CAPTCHAF4', 'todos los usuarios (incl. admins)');
DEFINE ('_UDDEADM_PUBFRONTEND_HEAD', 'Habilitar la Interfaz P�blica');
DEFINE ('_UDDEADM_PUBFRONTEND_EXP', 'Cuando est� habilitado, los usuarios p�blicos pueden enviar mensajes a los usuarios registrados (estos pueden especificar en sus opciones personles si quieren o no esta posibilidad).');
DEFINE ('_UDDEADM_PUBFRONTENDDEF_HEAD', 'Frente P�blico por omisi�n');
DEFINE ('_UDDEADM_PUBFRONTENDDEF_EXP', 'Este es el valor por omisi�n si a un usuario p�blico se le permite enviar un mensaje a un usuario registrado.');
DEFINE ('_UDDEADM_PUBDEF0', 'deshabilitado');
DEFINE ('_UDDEADM_PUBDEF1', 'habilitado');
DEFINE ('_UDDEIM_WRONGCAPTCHA', 'C�digo de seguridad equivocado');

// New: 1.0
DEFINE ('_UDDEADM_NONEORUNKNOWN', 'ninguno o desconocido');
DEFINE ('_UDDEADM_DONATE', 'Si te gusta uddeIM y quieres apoyar su desarrollo por favor haz una peque�a donaci�n.');
// New: 1.0rc2
DEFINE ('_UDDEADM_BACKUPRESTORE_DATE', 'Configuraci�n encontrada en la base de datos: ');
DEFINE ('_UDDEADM_BACKUPRESTORE_HEAD', 'Resguardar y restaurar la configuraci�n');

DEFINE ('_UDDEADM_BACKUPRESTORE_EXP', 'Puedes resguardar tu configuraci�n en la base de datos y reastaurarla cuando sea necesario. Esto es �til cuando actualizas uddeIM o cuando quieres guardar cierta configuraci�n mientras haces pruebas.');
DEFINE ('_UDDEADM_BACKUPRESTORE_BACKUP', 'BACKUP');
DEFINE ('_UDDEADM_BACKUPRESTORE_RESTORE', 'RESTAURAR');
DEFINE ('_UDDEADM_CANCEL', 'Cancelar');
// New: 1.0rc1
DEFINE ('_UDDEADM_LANGUAGECHARSET_HEAD', 'C�digo de caracteres del archivo de idiomas');
DEFINE ('_UDDEADM_LANGUAGECHARSET_EXP', 'Generalmente <strong>default</strong> (ISO-8859-1) es la configuraci�n correcta para Joomla 1.0 y <strong>UTF-8</strong> para Joomla 1.5.');
DEFINE ('_UDDEADM_LANGUAGECHARSET_UTF8', 'UTF-8');
DEFINE ('_UDDEADM_LANGUAGECHARSET_DEFAULT', 'default');
DEFINE ('_UDDEIM_READ_INFO_1', 'Los mensajes le�dos estar�n en la bandeja de entrada por ');
DEFINE ('_UDDEIM_READ_INFO_2', ' d�as max. antes de que se borren autom�ticamente.');
DEFINE ('_UDDEIM_UNREAD_INFO_1', 'Los mensajes NO le�dos estar�n en la bandeja de entrada por ');
DEFINE ('_UDDEIM_UNREAD_INFO_2', ' d�as max. antes de que se borren autom�ticamente.');
DEFINE ('_UDDEIM_SENT_INFO_1', 'Los mensajes enviados estar�n en la bandeja de salida por ');
DEFINE ('_UDDEIM_SENT_INFO_2', ' d�as max. antes de que se borren autom�ticamente.');
DEFINE ('_UDDEADM_DELETEREADAFTERNOTE_HEAD', 'Mostrar nota de la bandeja de entrada para mensajes le�dos');
DEFINE ('_UDDEADM_DELETEREADAFTERNOTE_EXP', 'Mostrar nota "Los mensajes le�dos se borrar�n luego de n d�as"');
DEFINE ('_UDDEADM_DELETEUNREADAFTERNOTE_HEAD', 'Mostrar nota de la bandeja de entrada para mensajes NO le�dos');
DEFINE ('_UDDEADM_DELETEUNREADAFTERNOTE_EXP', 'Mostrar nota "Los mensajes NO le�dos se borrar�n luego de n d�as"');
DEFINE ('_UDDEADM_DELETESENTAFTERNOTE_HEAD', 'Mostrar nota de la bandeja de salida para mensajes enviados');
DEFINE ('_UDDEADM_DELETESENTAFTERNOTE_EXP', 'Mostrar nota "Los mensajes enviados se borrar�n luego de n d�as"');
DEFINE ('_UDDEADM_DELETETRASHAFTERNOTE_HEAD', 'Mostrar nota de la papelera para mensajes enviados');
DEFINE ('_UDDEADM_DELETETRASHAFTERNOTE_EXP', 'Mostrar nota "Los mensajes de la papelera se purgar�n luego de n d�as"');
DEFINE ('_UDDEADM_DELETESENTAFTER_HEAD', 'Mensajes enviados retenidos por (d�as)');
DEFINE ('_UDDEADM_DELETESENTAFTER_EXP', 'Ingrese el n�mero de d�as hasta que los mensajes <b>enviados</b> se borrar�n autom�ticamente de la bandeja de salida.');
DEFINE ('_UDDEIM_SEND_TOALLSPECIAL', 'enviar a todos los usuarios especiales');
DEFINE ('_UDDEIM_SYSGM_WILLSENDTOALLSPECIAL', 'Mensaje para <strong>todos los usuarios especiales</strong>');
DEFINE ('_UDDEADM_USERSET_SELUSERNAME', '- seleccionar usuario -');
DEFINE ('_UDDEADM_USERSET_SELNAME', '- seleccionar nombre -');
DEFINE ('_UDDEADM_USERSET_EDITSETTINGS', 'Editar opciones de usuario');
DEFINE ('_UDDEADM_USERSET_EXISTING', 'existente');
DEFINE ('_UDDEADM_USERSET_NONEXISTING', 'no existente');
DEFINE ('_UDDEADM_USERSET_SELENTRY', '- seleccionar entrada -');
DEFINE ('_UDDEADM_USERSET_SELNOTIFICATION', '- seleccionar notificaci�n -');
DEFINE ('_UDDEADM_USERSET_SELPOPUP', '- seleccionar ventana emergente (popup) -');
DEFINE ('_UDDEADM_USERSET_USERNAME', 'Usuario');
DEFINE ('_UDDEADM_USERSET_NAME', 'Nombre');
DEFINE ('_UDDEADM_USERSET_NOTIFICATION', 'Notificaci�n');
DEFINE ('_UDDEADM_USERSET_POPUP', 'Emergente');
DEFINE ('_UDDEADM_USERSET_LASTACCESS', '�ltimo acceso');
DEFINE ('_UDDEADM_USERSET_NO', 'No');
DEFINE ('_UDDEADM_USERSET_YES', 'S�');
DEFINE ('_UDDEADM_USERSET_UNKNOWN', 'desconocido');
DEFINE ('_UDDEADM_USERSET_WHENOFFLINEEXCEPT', 'Cuando estoy desconectado (excepto respuestas)');
DEFINE ('_UDDEADM_USERSET_ALWAYSEXCEPT', 'Siempre (excepto respuestas)');
DEFINE ('_UDDEADM_USERSET_WHENOFFLINE', 'Cuando esto desconectado');
DEFINE ('_UDDEADM_USERSET_ALWAYS', 'Siempre');
DEFINE ('_UDDEADM_USERSET_NONOTIFICATION', 'Sin notificaci�n');
DEFINE ('_UDDEADM_WELCOMEMSG', "�Bienvenido a uddeIM!\n\nHas instalado exitosamente uddeIM.\n\nPrueba ver este mensaje con diferentes plantillas. Puedes seleccionarlas en el panel de administraci�n de  uddeIM.\n\nuddeIM es un project en desarrollo. Si encuentras errores (bugs) o debilidades, por favor escr�beme para que podamos mejorar uddeIM entre todos.\n\n�Buena Suerte y que te diviertas!");
DEFINE ('_UDDEADM_UDDEINSTCOMPLETE', 'instalaci�n de uddeIM completa.');
DEFINE ('_UDDEADM_REVIEWSETTINGS', 'Por favor contin�a con el panel de administraci�n y revisa las opciones.');
DEFINE ('_UDDEADM_REVIEWLANG', 'Si est�s ejecutando el CMS en un conjunto de caracteres que no sea ISO 8859-1 aseg�rate de ajustar las opciones correspondientes.');
DEFINE ('_UDDEADM_REVIEWEMAILSTOP', 'Luego de la instalaci�n, todo el tr�fico de emails de uddeIM (notificaciones de email, emails de olvido) est� deshabilitado para que no se env�en emails mientras haces las pruebas. No te olvides de deshabilitar la opci�n "Para email" en el panel de administraci�n cuando hayas terminado.');
DEFINE ('_UDDEADM_MAXRECIPIENTS_HEAD', 'M�x de destinatarios');
DEFINE ('_UDDEADM_MAXRECIPIENTS_EXP', 'M�x n�mero de destinatarios que son permitidos por mensaje (0=sin l�mite)');
DEFINE ('_UDDEIM_TOOMANYRECIPIENTS', 'demasiados destinatarios');
DEFINE ('_UDDEIM_STOPPEDEMAIL', 'Env�o de emails deshabilitado.');
DEFINE ('_UDDEADM_SEARCHINSTRING_HEAD', 'Buscar adentro del texto');
DEFINE ('_UDDEADM_SEARCHINSTRING_EXP', 'El Autocompletador busca dentro del texto (sino busca desde el comienzo solamente)');
DEFINE ('_UDDEADM_MODESHOWALLUSERS_HEAD', 'Comportamiento del link "Todos"');
DEFINE ('_UDDEADM_MODESHOWALLUSERS_EXP', 'Elija si el link "Todos" deber�a suprimirse, mostrarse o si siempre deber�an mostrarse todos los usuarios');
DEFINE ('_UDDEADM_MODESHOWALLUSERS_0', 'Suprimir el linke "Todos"');
DEFINE ('_UDDEADM_MODESHOWALLUSERS_1', 'Mostrar el link "Todos"');
DEFINE ('_UDDEADM_MODESHOWALLUSERS_2', 'Siempre mostrar todos los usuarios');
DEFINE ('_UDDEADM_CONFIGNOTWRITEABLE', 'La configuraci�n no es grabable:');
DEFINE ('_UDDEADM_CONFIGWRITEABLE', 'La configuration es grabable:');
DEFINE ('_UDDEIM_FORWARDLINK', 're-enviar');
DEFINE ('_UDDEIM_RECIPIENTFOUND', 'destinatario encontrado');
DEFINE ('_UDDEIM_RECIPIENTSFOUND', 'destinatarios encontrados');
DEFINE ('_UDDEADM_MAILSYSTEM_MOSMAIL', 'mosMail');
DEFINE ('_UDDEADM_MAILSYSTEM_PHPMAIL', 'php mail (default)');
DEFINE ('_UDDEADM_MAILSYSTEM_HEAD', 'Mailsystem');
DEFINE ('_UDDEADM_MAILSYSTEM_EXP', 'Seleccione el sistema de mail que uddeIM deber�a usar para enviar notificaciones.');
DEFINE ('_UDDEADM_SHOWGROUPS_HEAD', 'Mostrar los grupos de Joomla');
DEFINE ('_UDDEADM_SHOWGROUPS_EXP', 'Mostrar los grupos de Joomla groups en las lista de mensajes generales.');
DEFINE ('_UDDEADM_ALLOWFORWARDS_HEAD', 'Re-env�o de mensajes');
DEFINE ('_UDDEADM_ALLOWFORWARDS_EXP', 'Permitir el re-env�o de mensajes.');
DEFINE ('_UDDEIM_FWDFROM', 'Mensaje original de');
DEFINE ('_UDDEIM_FWDTO', 'para');

// New: 0.9+
DEFINE ('_UDDEIM_UNARCHIVE', 'Desarchivar mensaje');
DEFINE ('_UDDEIM_CANTUNARCHIVE', 'No se puede desarchivar el mensaje');
DEFINE ('_UDDEADM_ALLOWMULTIPLERECIPIENTS_HEAD', 'Permitir m�ltiples destinatarios');
DEFINE ('_UDDEADM_ALLOWMULTIPLERECIPIENTS_EXP', 'Permitir m�ltiples destinatarios (separados por comas).');
DEFINE ('_UDDEIM_CHARSLEFT', 'caracteres quedan sin usar');
DEFINE ('_UDDEADM_SHOWTEXTCOUNTER_HEAD', 'Mostrar contador de caracteres');
DEFINE ('_UDDEADM_SHOWTEXTCOUNTER_EXP', 'Muestra un contador que indica cu�ntos caracteres quedan por escribir.');
DEFINE ('_UDDEIM_CLEAR', 'Limpiar');
DEFINE ('_UDDEADM_ALLOWMULTIPLEUSER_HEAD', 'Agregar los destinatarios seleccionados a la lista');
DEFINE ('_UDDEADM_ALLOWMULTIPLEUSER_EXP', 'Esto permite seleccionar m�ltiples destinatarios.');
DEFINE ('_UDDEADM_CBALLOWMULTIPLEUSER_HEAD', 'Agregar las conexiones seleccionadas a la lista');
DEFINE ('_UDDEADM_CBALLOWMULTIPLEUSER_EXP', 'Esto permite seleccionar m�ltiples destinatarios.');
DEFINE ('_UDDEADM_PMSFOUND', 'PMS encontrado: ');
DEFINE ('_UDDEIM_ENTERNAME', 'ingrese un nombre');
DEFINE ('_UDDEADM_USEAUTOCOMPLETE_HEAD', 'Usar autocompletar');
DEFINE ('_UDDEADM_USEAUTOCOMPLETE_EXP', 'Usar autocompletar para los nombres de los destinatarios.');
DEFINE ('_UDDEADM_OBFUSCATING_HEAD', 'Clave usarda para ofuscaci�n');
DEFINE ('_UDDEADM_OBFUSCATING_EXP', 'Ingresa la clave que ser� usada para ofuscaci�n de mensajes. No cambie este valor luego de que se haya habilitado la ofuscaci�n de mensajes.');
DEFINE ('_UDDEADM_CFGFILE_NOTFOUND', '�Se encontr� un archivo de configuraci�n err�neo!');
DEFINE ('_UDDEADM_CFGFILE_FOUND', 'Versi�n encontrada:');
DEFINE ('_UDDEADM_CFGFILE_EXPECTED', 'Versi�n esperada:');
DEFINE ('_UDDEADM_CFGFILE_CONVERTING', 'Actualizando configuraci�n...');
DEFINE ('_UDDEADM_CFGFILE_DONE', 'Listo!');
DEFINE ('_UDDEADM_CFGFILE_WRITEFAILED', 'Error cr�tico: Fall� la grabaci�n del archivo de configuraci�n:');

// New: 0.8+
DEFINE ('_UDDEIM_ENCRYPTDOWN', '�Mensaje encriptado! - �No es posible bajarlo!');
DEFINE ('_UDDEIM_WRONGPASSDOWN', '�Clave err�nera! - �No es posible bajarlo!');
DEFINE ('_UDDEIM_WRONGPW', '�Clave err�nera! - �Por favor cont�ctese con el administrador!');
DEFINE ('_UDDEIM_WRONGPASS', '�Clave err�nera!');
DEFINE ('_UDDEADM_MAINTENANCE_D1', 'Fechas de papelera err�neas (bandejas de entrada/salida): ');
DEFINE ('_UDDEADM_MAINTENANCE_D2', 'Corrigiendo las fechas err�neas de papelera');
DEFINE ('_UDDEIM_TODP', 'Para: ');
DEFINE ('_UDDEADM_MAINTENANCE_PRUNE', 'Podar mensajes ahora');
DEFINE ('_UDDEADM_SHOWACTIONICONS_HEAD', 'Mostrar �conocs de acci�n');
DEFINE ('_UDDEADM_SHOWACTIONICONS_EXP', 'Cuando se elige <i>s�</i>, los v�nculos de acci�n se mostrar�n con un  �cono.');
DEFINE ('_UDDEIM_UNCHECKALL', 'desmarcar todos');
DEFINE ('_UDDEIM_CHECKALL', 'marcar all');
DEFINE ('_UDDEADM_SHOWBOTTOMICONS_HEAD', 'Mostrar �conos en el pie');
DEFINE ('_UDDEADM_SHOWBOTTOMICONS_EXP', 'Cuando se elije <i>s�s</i>, los v�nculos del pie se mostrar�n con un  �cono.');
DEFINE ('_UDDEADM_ANIMATED_HEAD', 'Usar smileys animados');
DEFINE ('_UDDEADM_ANIMATED_EXP', 'Usar smileys animados en lugar de los fijos.');
DEFINE ('_UDDEADM_ANIMATEDEX_HEAD', 'M�s smileys animados');
DEFINE ('_UDDEADM_ANIMATEDEX_EXP', 'Mostrar m�s smileys animados.');
DEFINE ('_UDDEIM_PASSWORDREQ', 'Mensaje encriptado - Se requiere contrase�a');
DEFINE ('_UDDEIM_PASSWORD', '<strong>Contrase�a requerida</strong>');
DEFINE ('_UDDEIM_PASSWORDBOX', 'Contrase�a');
DEFINE ('_UDDEIM_ENCRYPTIONTEXT', ' (text de encripci�n)');
DEFINE ('_UDDEIM_DECRYPTIONTEXT', ' (texto de des-encripci�n)');
DEFINE ('_UDDEIM_MORE', 'MAS');
// uddeIM Module
DEFINE ('_UDDEMODULE_PRIVATEMESSAGES', 'Mensajes privados');
DEFINE ('_UDDEMODULE_NONEW', 'no hay nuevos');
DEFINE ('_UDDEMODULE_NEWMESSAGES', 'Nuevos mensajes: ');
DEFINE ('_UDDEMODULE_MESSAGE', 'mensaje');
DEFINE ('_UDDEMODULE_MESSAGES', 'mensajes');
DEFINE ('_UDDEMODULE_YOUHAVE', 'Tienes');
DEFINE ('_UDDEMODULE_HELLO', 'Hola');
DEFINE ('_UDDEMODULE_EXPRESSMESSAGE', 'Centro de mensajes');

// New: 0.7+
DEFINE ('_UDDEADM_USEENCRYPTION', 'Usar encripci�n');
DEFINE ('_UDDEADM_USEENCRYPTIONDESC', 'Encriptar mensajes almacenados');
DEFINE ('_UDDEADM_CRYPT0', 'Ninguna');
DEFINE ('_UDDEADM_CRYPT1', 'Ofuscar mensajes');
DEFINE ('_UDDEADM_CRYPT2', 'Encriptar mensajes');
DEFINE ('_UDDEADM_NOTIFYDEFAULT_HEAD', 'Por omisi�n para notificaciones por email');
DEFINE ('_UDDEADM_NOTIFYDEFAULT_EXP', 'Valor por omisi�n para la notificaci�n por email (para usuarios que no han cambiado sus preferencias todav�a).');
DEFINE ('_UDDEADM_NOTIFYDEF_0', 'Sin notificaci�n');
DEFINE ('_UDDEADM_NOTIFYDEF_1', 'Siempre');
DEFINE ('_UDDEADM_NOTIFYDEF_2', 'Cuando estoy desconectado');
DEFINE ('_UDDEADM_SUPPRESSALLUSERS_HEAD', 'Suprimir v�nculo "Todos"');
DEFINE ('_UDDEADM_SUPPRESSALLUSERS_EXP', 'Suprimir v�nculo "Todos" en el cuadro de escribir un mensaje nuevo  (�til cuando hay muchos usuarios registrados).');
DEFINE ('_UDDEADM_POPUP_HEAD','Notificaci�n emergente');
DEFINE ('_UDDEADM_POPUP_EXP','Mostrar un mensaje emergente (popup) cuando llega un mensaje nuevo (requiere mod_uddeim o mod_cblogin emparchado)');
DEFINE ('_UDDEIM_OPTIONS', 'M�s opciones');
DEFINE ('_UDDEIM_OPTIONS_EXP', 'Aqu� puedes configurar m�s opciones.');
DEFINE ('_UDDEIM_OPTIONS_P', 'Mostrar un mensaje emergente (popup) cuando llega un mensaje nuevo');
DEFINE ('_UDDEADM_POPUPDEFAULT_HEAD', 'Notificacion emergente (Popup) por omisi�n');
DEFINE ('_UDDEADM_POPUPDEFAULT_EXP', 'Habilitar la notificaci�n con una ventana emergente (popup) por omisi�n (para los usuarios que no han cambiado sus preferencias todav�a).');
DEFINE ('_UDDEADM_MAINTENANCE', 'Mantenimiento');
DEFINE ('_UDDEADM_MAINTENANCE_HEAD', 'Mantenimiento de la base de datos');
DEFINE ('_UDDEADM_MAINTENANCE_CHECK', 'CHECK');
DEFINE ('_UDDEADM_MAINTENANCE_TRASH', 'REPARAR');
DEFINE ('_UDDEADM_MAINTENANCE_EXP', "Cuando un usuario es purgado de la bse de datos sus menesajes usualmente se retienen. Esta funci�n permite revisar si es necesario purgar mensajes hu�rfanos y si se pueden purgar si es requerido.<br />Esto tambi�n chequea algunos errores en la base de datos que ser�n corregidos.");
DEFINE ('_UDDEADM_MAINTENANCE_MC1', "Verificando...<br />");
DEFINE ('_UDDEADM_MAINTENANCE_MC2', "<i>#nnn (Usuario): [inbox|inbox trashed|outbox|outbox trashed]</i><br />");
DEFINE ('_UDDEADM_MAINTENANCE_MC3', "<i>inbox: mensajes almacenados en las inbox de los usuarios</i><br />");
DEFINE ('_UDDEADM_MAINTENANCE_MC4', "<i>inbox trashed: mensajes borrados en las inbox de los usuarios, pero que todav�a est� en la outbox de alguien</i><br />");
DEFINE ('_UDDEADM_MAINTENANCE_MC5', "<i>outbox: mensajes almacenados en las outbox de los usuarios</i><br />");
DEFINE ('_UDDEADM_MAINTENANCE_MC6', "<i>outbox trashed: mensajes borrados de las outbox de los usuarios, peroq ue est�n todav�a en la inbox de alguien</i><br />");
DEFINE ('_UDDEADM_MAINTENANCE_MT1', "Purgando...<br />");
DEFINE ('_UDDEADM_MAINTENANCE_NOTFOUND', "no encontrado (de/para/opciones/bloqueador/bloqueado):");
DEFINE ('_UDDEADM_MAINTENANCE_MT2', "borrar todas las preferencias para el usuario");
DEFINE ('_UDDEADM_MAINTENANCE_MT3', "borrar el bloqueo del usuario");
DEFINE ('_UDDEADM_MAINTENANCE_MT4', "borrar todos los mensajes enviados al usuario eliminado en la bandeja de salida del remitente y en la de entrada del usuario eliminado");
DEFINE ('_UDDEADM_MAINTENANCE_MT5', "borrar todos los mensajes enviados del usuario eliminado en su bandeja de salida y la de entrada del remitente");
DEFINE ('_UDDEADM_MAINTENANCE_NOTHINGTODO', '<b>Nada que hacer</b><br />');
DEFINE ('_UDDEADM_MAINTENANCE_JOBTODO', '<b>Mantenimiento requerido</b><br />');

// New: 0.6+
DEFINE ('_UDDEADM_NAMESTEXT', 'Mostrar nombres reales');
DEFINE ('_UDDEADM_NAMESDESC', '�Nombres reales o de usuario?');
DEFINE ('_UDDEADM_REALNAMES', 'Nombre reales');
DEFINE ('_UDDEADM_USERNAMES', 'Nombres de usuario');
DEFINE ('_UDDEADM_CONLISTBOX', 'Lista de conexiones');
DEFINE ('_UDDEADM_CONLISTBOXDESC', '�Mostrar mis conexiones en una lista o una tabla?');
DEFINE ('_UDDEADM_LISTBOX', 'Lista');
DEFINE ('_UDDEADM_TABLE', 'Tabla');

DEFINE ('_UDDEIM_TRASHCAN_INFO', 'Los mensajes estar�n en la papelera durante 24hs antes de que sean purgados. Solo puedes ver las primeras palabras del mensaje. Para leer el mensaje entero necesitas restaurarlo primero.');
DEFINE ('_UDDEIM_TRASHCAN_INFO_1', 'Los mensajes estar�n en la papelera durante ');
DEFINE ('_UDDEIM_TRASHCAN_INFO_2', ' hs antes de que sean purgados. Solo puedes ver las primeras palabras del mensaje. Para leer el mensaje entero necesitas restaurarlo primero.');
DEFINE ('_UDDEIM_RECALLEDMESSAGE_INFO', 'Este mensaje ha sido recuperado. Ahora puedes editarlo o volverlo a mandar.');
DEFINE ('_UDDEIM_COULDNOTRECALL', 'El mensaje no ha podido ser recuperado (probablemente porque ha sido le&iacute;do o borrado.)');
DEFINE ('_UDDEIM_CANTRESTORE', 'La restauraci&oacute;n del mensaje ha fallado. ( Debe haber estado demasiado tiempo en la papelera y ha sido borrado.)');
DEFINE ('_UDDEIM_COULDNOTRESTORE', 'La restauraci&oacute;n del mensaje ha fallado.');
DEFINE ('_UDDEIM_DONTSEND', 'No enviar');
DEFINE ('_UDDEIM_SENDAGAIN', 'Reenviar');
DEFINE ('_UDDEIM_NOTLOGGEDIN', 'No has iniciado sesi&oacute;n');
DEFINE ('_UDDEIM_NOMESSAGES_INBOX', '<strong>No hay mensajes en tu bandeja de entrada.</strong>');
	// changed in 0.4 (one dot that was too much after </strong> deleted)
	
DEFINE ('_UDDEIM_NOMESSAGES_OUTBOX', '<strong>No hay mensajes en tu bandeja de salida.</strong>');
DEFINE ('_UDDEIM_NOMESSAGES_TRASHCAN', '<strong>No hay mensajes en tu papelera.</strong>');
DEFINE ('_UDDEIM_INBOX', 'Bandeja de entrada');
DEFINE ('_UDDEIM_OUTBOX', 'Bandeja de salida');
DEFINE ('_UDDEIM_TRASHCAN', 'Papelera');
DEFINE ('_UDDEIM_CREATE', 'Nuevo mensaje');
DEFINE ('_UDDEIM_UDDEIM', 'Mensajes privados');
DEFINE ('_UDDEIM_READSTATUS', 'Le&iacute;do');
DEFINE ('_UDDEIM_FROM', 'De');
DEFINE ('_UDDEIM_FROM_SMALL', 'de');
DEFINE ('_UDDEIM_TO', 'Para');
DEFINE ('_UDDEIM_TO_SMALL', 'para');
DEFINE ('_UDDEIM_OUTBOX_WARNING', 'Tu bandeja de salida contiene todos los mensajes que has enviado y no has borrado todav�a. Puedes memorizar un mensaje en tu bandeja de salida si este no ha sido le�do. Si haces esto, ya no podr� ser le�do por el destinatario del mensaje. ');
	// changed in 0.4

DEFINE ('_UDDEIM_RECALL', 'recuperar');
DEFINE ('_UDDEIM_RECALLTHISMESSAGE', 'Recuperar este mensaje');
DEFINE ('_UDDEIM_RESTORE', 'restaurar');
DEFINE ('_UDDEIM_MESSAGE', 'Mensaje');
DEFINE ('_UDDEIM_DATE', 'Fecha');
DEFINE ('_UDDEIM_DELETED', 'Borrado');
DEFINE ('_UDDEIM_DELETE', 'borrar');
DEFINE ('_UDDEIM_ONLINEPIC', 'images/icon_online.gif');
DEFINE ('_UDDEIM_OFFLINEPIC', 'images/icon_offline.gif');
DEFINE ('_UDDEIM_DELETELINK', 'borrar');
DEFINE ('_UDDEIM_MESSAGENOACCESS', 'Este mensaje no puede ser mostrado. <br />Motivos posibles:<ul><li>No tienes permiso para leer este mensaje particular</li><li>Este mensaje ha sido borrado</li></ul>');
DEFINE ('_UDDEIM_YOUMOVEDTOTRASH', '<b>Has movido este mensaje a la papelera.</b>');
DEFINE ('_UDDEIM_MESSAGEFROM', 'Mensaje de ');
DEFINE ('_UDDEIM_MESSAGETO', 'Mensaje para ');
DEFINE ('_UDDEIM_REPLY', 'Responder');
DEFINE ('_UDDEIM_SUBMIT', 'Enviar');
DEFINE ('_UDDEIM_DELETEREPLIED', 'Mover el mensaje a la papelera despu�s de responderlo');
	// translators info: _UDDEIM_DELETEREPLIED is obsolete in 0.4. You can delete it.
DEFINE ('_UDDEIM_NOID', 'Error: No se ha encontrado la ID del destinatario. No se ha enviado el mensaje.');
DEFINE ('_UDDEIM_NOMESSAGE', 'Error: El mensaje esta vac�o! No se ha enviado el mensaje.');
DEFINE ('_UDDEIM_MESSAGE_REPLIEDTO', 'Respuesta enviada');
DEFINE ('_UDDEIM_MESSAGE_SENT', 'Mensaje enviado');
DEFINE ('_UDDEIM_MOVEDTOTRASH', ' y el mensaje original ha sido enviado a la papelera');
DEFINE ('_UDDEIM_NOSUCHUSER', 'No existe ning&uacute;n usuario con este nombre!');
DEFINE ('_UDDEIM_NOTTOYOURSELF', 'No es posible enviarse mensajes a si mismo!');
DEFINE ('_UDDEIM_VIOLATION', '<b>Acceso denegado!</b> No tienes el permiso para realizar esta acci&oacute;n!');
DEFINE ('_UDDEIM_PRUNELINK', 'Solo administradores: Pasa');

// Admin

DEFINE ('_UDDEADM_SETTINGS', 'Administraci&oacute;n uddeIM ');
DEFINE ('_UDDEADM_GENERAL', 'General');
DEFINE ('_UDDEADM_ABOUT', 'Acerca de');
DEFINE ('_UDDEADM_DATESETTINGS', 'Fecha/hora');
DEFINE ('_UDDEADM_PICSETTINGS', 'Iconos');
DEFINE ('_UDDEADM_DELETEREADAFTER_HEAD', 'Mantener mensajes le�dos durante (d�as)');
DEFINE ('_UDDEADM_DELETEUNREADAFTER_HEAD', 'Mantener mensajes NO le�dos durante (d�as)');
DEFINE ('_UDDEADM_DELETETRASHAFTER_HEAD', 'Mantener mensajes en la papelera durante (d�as)');
DEFINE ('_UDDEADM_DAYS', 'd�a(s)');
DEFINE ('_UDDEADM_DELETEREADAFTER_EXP', 'Introduce el numero de d�as que permanecer�n los mensajes <b>le�dos</b> en la bandeja de entrada. Si no quieres que se borren los mensajes autom�ticamente, introduce un numero alto (por ejemplo, 36524 d�as equivalen a un siglo). Pero recuerda que la Base de datos se llenara r�pidamente si conservas todos los mensajes.');
DEFINE ('_UDDEADM_DELETEUNREADAFTER_EXP', 'Introduce el numero de d�as que permanecer�n los mensajes que <b>NO</b> han sido le�dos a&uacute;n por el destinatario antes de borrarse.');
DEFINE ('_UDDEADM_DELETETRASHAFTER_EXP', 'Introduce el numero de d�as que permanecer�n los mensajes en la papelera antes de purgarse. Valores menores de un d�a est�n permitidos. Por ejemplo: Para borrar los mensajes de la papelera desp&uacute;es de 3 horas, introduce 0.125 como valor.');
DEFINE ('_UDDEADM_DATEFORMAT_HEAD', 'Formato de la fecha');
DEFINE ('_UDDEADM_DATEFORMAT_EXP', 'Elige el formato en el cual ser&aacute; mostrada la fecha/hora del mensaje. Los meses son abreviados de acuerdo a las preferencias de lenguaje en Mambo (si se encuentra un archivo de lenguaje de uddeIM que coincida).');
DEFINE ('_UDDEADM_LDATEFORMAT_HEAD', 'Formato de fecha largo');
DEFINE ('_UDDEADM_LDATEFORMAT_EXP', 'Cuando se muestra el mensaje hay m&aacute;s espacio para mostrar la fecha. Elige el formato de fecha que se mostrar&aacute; cuando se abra un mensaje. Para los d�as de la semana y los meses, se aplicar&aacute;n las preferencias de lenguaje de Mambo (si se encuentra un archivo de lenguaje de uddeIM que coincida).');
DEFINE ('_UDDEADM_ADMINIGNITIONONLY_HEAD', 'Borrado solo por administradores');
DEFINE ('_UDDEADM_ADMINIGNITIONONLY_YES', 'si, solo por admins');
DEFINE ('_UDDEADM_ADMINIGNITIONONLY_NO', 'no, por cualquier usuario');
DEFINE ('_UDDEADM_ADMINIGNITIONONLY_EXP', 'Los borrados autom�ticos son una pesada carga para los servidores y las bases de datos. Si elige "<i>si,&nbsp;solo&nbsp;por&nbsp;admins</i>" el borrado autom�tico de acuerdo con la configuraci&oacute;n de arriba (de todos los mensajes de usuario) es invocado cuando cualquier administrador comprueba su bandeja de entrada. Elija esta opci&oacute;n si cualquier administrador comprueba su bandeja de entrada todos los d�as o m&aacute;s frecuentemente, que es el caso de la mayor�a de sitios web. (Si tu sitio web tiene m&aacute;s de un administrador, no importa cual de todos es el que entra porque el borrado es invocado autom�ticamente cuando entra cualquier admin.) Para sitios web peque&ntilde;os o poco administrados donde no suelen entrar los administradores a consultar sus bandejas de entrada, elije "<i>no,&nbsp;por&nbsp;cualquier&nbsp;usuario</i>". Si no entiendes esto o no sabes que opci&oacute;n elegir, elige "<i>no, por cualquier usuario</i>".');
DEFINE ('_UDDEADM_SAVESETTINGS', 'Guardar Configuraci&oacute;n');
DEFINE ('_UDDEADM_THISHASBEENSAVED', 'Los siguientes ajustes se han guardado en el archivo de configuraci&oacute;n:');
DEFINE ('_UDDEADM_SETTINGSSAVED', 'La Configuraci&oacute;n ha sido guardada.');
DEFINE ('_UDDEADM_ICONONLINEPIC_HEAD', 'Icono: Usuario en linea');
DEFINE ('_UDDEADM_ICONONLINEPIC_EXP', 'Introduce la ubicaci&oacute;n del icono que ser&aacute; mostrado al lado del nombre de usuario cuando este este en linea.');
DEFINE ('_UDDEADM_ICONOFFLINEPIC_HEAD', 'Icono: Usuario desconectado');
DEFINE ('_UDDEADM_ICONOFFLINEPIC_EXP', 'Introduce la ubicaci&oacute;n del icono que ser&aacute; mostrado al lado del nombre de usuario cuando este este conectado.');
DEFINE ('_UDDEADM_ICONREADPIC_HEAD', 'Icono: Mensaje le�do');
DEFINE ('_UDDEADM_ICONREADPIC_EXP', 'Introduce la ubicaci&oacute;n del icono que ser&aacute; mostrado para los mensajes le�dos');
DEFINE ('_UDDEADM_ICONUNREADPIC_HEAD', 'Icono: Mensaje no le�do');
DEFINE ('_UDDEADM_ICONUNREADPIC_EXP', 'Introduce la ubicaci&oacute;n del icono que ser&aacute; mostrado para los mensajes <b>NO</b> le�dos');
DEFINE ('_UDDEADM_MODULENEWMESS_HEAD', 'Modulo: Icono de nuevos mensajes');
DEFINE ('_UDDEADM_MODULENEWMESS_EXP', 'Esta opci&oacute;n hace referencia al modulo mod_uddeim_new. Introduce la ubicaci&oacute;n del icono que ser&aacute; mostrado cuando hayan nuevos mensajes.');

// admin import tab

DEFINE ('_UDDEADM_UDDEINSTALL', 'Instalaci&oacute;n uddeIM ');
DEFINE ('_UDDEADM_FINISHED', 'La instalaci&oacute;n ha terminado. Bienvenido a uddeIM. ');
DEFINE ('_UDDEADM_NOCB', '<span style="color: red;">No tienes el "Mambo Community Builder" instalado. no vas a poder usar uddeIM.</span><br /><br />Deber�as descargar <a href="http://www.mambojoe.com">"Mambo Community Builder"</a>.');
DEFINE ('_UDDEADM_CONTINUE', 'continuar');
DEFINE ('_UDDEADM_PMSFOUND_1', 'Hay ');
DEFINE ('_UDDEADM_PMSFOUND_2', ' mensajes en tu instalaci&oacute;n de PMS. �Deseas importarlos a uddeIM?');
DEFINE ('_UDDEADM_IMPORT_EXP', 'Esto no alterara los mensajes o tu instalaci&oacute;n de PMS. Permanecer�n intactos. as&iacute; puedes importarlos a uddeIM de forma segura, incluso si piensas seguir usando PMS. (Debes salvar cualquier cambio que hayas hecho a la configuraci&oacute;n antes de ejecutar la importaci&oacute;n!) Cualquier mensaje que ya tengas en la base de datos de uddeIM permanecer� intacto.');
	// _UDDEADM_IMPORT_EXP above changed in 0.4
	
DEFINE ('_UDDEADM_IMPORT_YES', 'Importar los mensajes de PMS a uddeIM ahora');
DEFINE ('_UDDEADM_IMPORT_NO', 'No, no importar ning&uacute;n mensaje');  
DEFINE ('_UDDEADM_IMPORTING', 'Por favor espere mientras los mensajes son importados.');
DEFINE ('_UDDEADM_IMPORTDONE', 'Importaci&oacute;n de mensajes desde PMS concluida. No vuelva a ejecutar este script de instalaci&oacute;n porque si lo hace importara los mensajes otra vez y se mostrar&aacute;n duplicados.'); 
DEFINE ('_UDDEADM_IMPORT', 'Importar');
DEFINE ('_UDDEADM_IMPORT_HEADER', 'Importar mensajes desde PMS');
DEFINE ('_UDDEADM_PMSNOTFOUND', 'No se ha encontrado una instalaci&oacute;n de PMS. No es posible importar.');
DEFINE ('_UDDEADM_ALREADYIMPORTED', '<span style="color: red;">Ya has importado los mensajes de PMS a uddeIM.</span>');

// new in 0.3 Frontend
DEFINE ('_UDDEIM_BLOCKS', 'Blocked');
DEFINE ('_UDDEIM_YOUAREBLOCKED', 'No se ha podido enviar (el usuario le ha bloqueado)');
DEFINE ('_UDDEIM_BLOCKNOW', 'usuario&nbsp;bloqueado');
DEFINE ('_UDDEIM_BLOCKS_EXP', 'Esta es una lista de los usuario que has bloqueado. Estos usuarios no pueden enviarte mensajes privados.');
DEFINE ('_UDDEIM_NOBODYBLOCKED', 'Actualmente no tienes ning&uacute;n usuario bloqueado.');
DEFINE ('_UDDEIM_YOUBLOCKED_PRE', 'Actualmente tienes ');
DEFINE ('_UDDEIM_YOUBLOCKED_POST', ' usuario(s) bloqueado(s).');
DEFINE ('_UDDEIM_UNBLOCKNOW', '[desbloquear]');
DEFINE ('_UDDEIM_BLOCKALERT_EXP_ON', 'Si un usuario bloqueado intenta enviarte un mensaje, &eacute;l o ella ser&aacute; informado de que ha sido bloqueado y de que el mensaje no se ha enviado.');
DEFINE ('_UDDEIM_BLOCKALERT_EXP_OFF', 'Un usuario bloqueado no puede ver que lo has bloqueado');
DEFINE ('_UDDEIM_CANTBLOCKADMINS', 'No puedes bloquear a los administradores.');

// new in 0.3 Admin
DEFINE ('_UDDEADM_BLOCKSYSTEM_HEAD', 'Activar el sistema de bloqueo');
DEFINE ('_UDDEADM_BLOCKSYSTEM_EXP', 'Cuando esta activo, los usuarios pueden bloquear a otros usuarios. Un usuario bloqueado no puede enviar mensajes a el usuario que lo ha bloqueado. Los administradores no pueden ser bloqueados.');
DEFINE ('_UDDEADM_BLOCKSYSTEM_YES', 'S&iacute;');
DEFINE ('_UDDEADM_BLOCKSYSTEM_NO', 'No');
DEFINE ('_UDDEADM_BLOCKALERT_HEAD', 'Usuarios bloqueados reciben mensaje');
DEFINE ('_UDDEADM_BLOCKALERT_EXP', 'Si elige <i>S&iacute;</i>, el usuario bloqueado sera informado de que su mensaje no ha podido ser enviado porque ha sido bloqueado por el receptor. Si elige <i>No</i>, el usuario bloqueado no recibir&aacute; ninguna notificaci&oacute;n de que su mensaje no se ha enviado.');
DEFINE ('_UDDEADM_BLOCKALERT_YES', 'S&iacute;');
DEFINE ('_UDDEADM_BLOCKALERT_NO', 'No');
DEFINE ('_UDDEIM_BLOCKSDISABLED', 'Sistema de bloqueo no activo');
// DEFINE ('_UDDEADM_DELETIONS', 'Mensajes'); 
	// translators info: comment out or delete line above to avoid double definition.
	// new definition right below.
DEFINE ('_UDDEADM_DELETIONS', 'Borrados'); // changed in 0.4
DEFINE ('_UDDEADM_BLOCK', 'Bloqueos');

// new in 0.4, admin
DEFINE ('_UDDEADM_INTEGRATION', 'Integraci&oacute;n');
DEFINE ('_UDDEADM_EMAIL', 'E-mail');
DEFINE ('_UDDEADM_SHOWCBLINK_HEAD', 'Mostrar enlaces CB');
DEFINE ('_UDDEADM_SHOWCBLINK_EXP', 'Cuando esta en <i>S&iacute;</i>, Todos los nombres de usuario que aparezcan en uddeIM ser&aacute;n mostrados como enlaces a su perfil de  "Community Builder".');
DEFINE ('_UDDEADM_SHOWCBPIC_HEAD', 'Mostrar miniatura CB');
DEFINE ('_UDDEADM_SHOWCBPIC_EXP', 'Cuando esta en <i>S&iacute;</i>, la miniatura de el usuario ser&aacute; mostrada al leer un mensaje (Si &eacute;l o ella dispone de una imagen en su perfil "Community Builder").');
DEFINE ('_UDDEADM_SHOWONLINE_HEAD', 'Mostrar el estado del usuario');
DEFINE ('_UDDEADM_SHOWONLINE_EXP', 'Si elige <i>S&iacute;</i>, uddeIM mostrar&aacute; cada nombre de usuario con un peque&ntilde;o icono que informa de si ese usuario esta en linea o no. Puedes cambiar estos iconos en la pesta&ntilde;a Iconos.');
DEFINE ('_UDDEADM_ALLOWEMAILNOTIFY_HEAD', 'Permitir notificaci&oacute;n por correo');
DEFINE ('_UDDEADM_ALLOWEMAILNOTIFY_EXP', 'Si elige <i>S&iacute;</i>, cada usuario podr&aacute; elegir si quiere recibir un correo cada vez que reciba un mensaje en su bandeja de entrada.');
DEFINE ('_UDDEADM_EMAILWITHMESSAGE_HEAD', 'El correo contiene el mensaje');
DEFINE ('_UDDEADM_EMAILWITHMESSAGE_EXP', 'Si esta en <i>No</i>, este correo solo contendr&aacute; informaci&oacute;n sobre quien y cuando ha enviado el mensaje, pero no contendr&aacute; el mensaje en si.');
DEFINE ('_UDDEADM_LONGWAITINGEMAIL_HEAD', 'Correo recordatorio');
DEFINE ('_UDDEADM_LONGWAITINGEMAIL_EXP', 'Esta caracter&iacute;stica  manda - independientemente de los ajustes del usuario - un correo a el usuario que tiene mensajes no le&iacute;dos en su bandeja de entrada desde hace mucho tiempo (ver abajo). Esta caracter&iacute;stica es independiente de opci&oacute;n "permitir notificaciones por correo" de arriba. Si no quieres que se env&iacute;e ning&uacute;n correo, deber&aacute; desactivar las dos opciones.');
DEFINE ('_UDDEADM_LONGWAITINGDAYS_HEAD', 'Enviar correo recordatorio despu&eacute;s de');
DEFINE ('_UDDEADM_LONGWAITINGDAYS_EXP', 'Si la opci&oacute;n de recordatorio (ver arriba) est&aacute; en <i>S&iacute;</i>, pon aqu&iacute; cuantos d&iacute;as tardaran en ser enviados los correos de recordatorio avisando de que hay mensajes sin leer.');
DEFINE ('_UDDEADM_FIRSTWORDSINBOX_HEAD', 'Lista de los primeros caracteres');
DEFINE ('_UDDEADM_FIRSTWORDSINBOX_EXP', 'Aqu&iacute; puedes poner cuantos caracteres de el contenido de un mensaje se mostraran en la bandeja de entrada, salida y papelera.');
DEFINE ('_UDDEADM_MAXLENGTH_HEAD', 'Longitud m&aacute;xima del mensaje');
DEFINE ('_UDDEADM_MAXLENGTH_EXP', 'Pon aqu&iacute; la longitud m&aacute;xima de el mensaje. El mensaje ser&aacute; cortado autom&aacute;ticamente por esta longitud. Si se pone a "0" se permitir&aacute;n mensajes de cualquier longitud (no recomendado).');
DEFINE ('_UDDEADM_YES', 'S&iacute;');
DEFINE ('_UDDEADM_NO', 'No');
DEFINE ('_UDDEADM_ADMINSONLY', 'solo administradores');
DEFINE ('_UDDEADM_SYSTEM', 'Sistema');
DEFINE ('_UDDEADM_SYSM_USERNAME_HEAD', 'Nombre de usuario para mensajes del sistema');
DEFINE ('_UDDEADM_SYSM_USERNAME_EXP', 'uddeIM soporta mensajes del sistema. Estos no tienen un remitente visible y los usuarios no podr&aacute;n responder al mensaje. Introduce aqu&iacute; el alias para los mensajes del sistema (por ejemplo <i>Soporte</i> o <i>Informaci&oacute;n</i> or <i>Administrador de la comunidad</i>)');
DEFINE ('_UDDEADM_ALLOWTOALL_HEAD', 'Permitir a los administradores enviar mensajes generales');
DEFINE ('_UDDEADM_ALLOWTOALL_EXP', 'uddeIM soporta mensajes generales. Estos son enviados a todos los usuarios del sistema. No abuse de ellos.');
DEFINE ('_UDDEADM_EMN_SENDERNAME_HEAD', 'Nombre del remitente del correo');
DEFINE ('_UDDEADM_EMN_SENDERNAME_EXP', 'Introduce el nombre del remitente que usaran las notificaciones de correo (por ejemplo <i>ELNOBREDESUSITIOWEB</i>)');
DEFINE ('_UDDEADM_EMN_SENDERMAIL_HEAD', 'Direcci&oacute;n de correo del remitente');
DEFINE ('_UDDEADM_EMN_SENDERMAIL_EXP', 'Introduzca la direcci&oacute;n de correo desde la cual ser&aacute;n enviadas las notificaciones de correo (esta debe ser la direcci&oacute;n principal del correo de contacto de su sitio web).');
DEFINE ('_UDDEADM_VERSION', 'versi&oacute;n uddeIM ');
DEFINE ('_UDDEADM_ARCHIVE', 'Archivo'); // translators info: headline for Archive system
DEFINE ('_UDDEADM_ALLOWARCHIVE_HEAD', 'Activar archivo');
DEFINE ('_UDDEADM_ALLOWARCHIVE_EXP', 'Elija si se permite a los usuarios guardar los mensajes en el archivo. Los mensajes en el archivo no ser&aacute;n borrados.');
DEFINE ('_UDDEADM_MAXARCHIVE_HEAD', 'Numero m&aacute;ximo de mensajes en el archivo del usuario');
DEFINE ('_UDDEADM_MAXARCHIVE_EXP', 'Pon cuantos mensajes podr&aacute; guardar cada usuario en el archivo (este limite no se aplica a los administradores).');
DEFINE ('_UDDEADM_COPYTOME_HEAD', 'Permitir auto copias');
DEFINE ('_UDDEADM_COPYTOME_EXP', 'Permite a los usuarios recibir copias de los mensajes que manden. Estas copias aparecer&aacute;n en la bandeja de entrada.');
DEFINE ('_UDDEADM_MESSAGES', 'Mensajes');
DEFINE ('_UDDEADM_TRASHORIGINAL_HEAD', 'Sugerir descartar el original');
DEFINE ('_UDDEADM_TRASHORIGINAL_EXP', 'Cuando esta activa esta opci&oacute;n, pondr&aacute; una casilla al lado de el bot&oacute;n \'Enviar\' llamada \'descartar original\' que estar&aacute; activa por defecto. En este caso, el mensaje sera inmediatamente movido de la bandeja de entrada a la papelera cuando la respuesta se haya enviado. Esta opci&oacute;n mantiene baja la cantidad de mensajes en la base de datos. Los usuarios siempre pueden deseleccionar la casilla si quieren conservar el mensaje en la bandeja de entrada.');
	// translators info: 'Send' is the same as _UDDEIM_SUBMIT, 
	// and 'trash original' the same as _UDDEIM_TRASHORIGINAL
	
DEFINE ('_UDDEADM_PERPAGE_HEAD', 'Mensajes por p&aacute;gina');	
DEFINE ('_UDDEADM_PERPAGE_EXP', 'Define el numero de mensajes que ser&aacute;n mostrados por p&aacute;gina en la bandeja de entrada, salida, papelera y archivo.');
DEFINE ('_UDDEADM_CHARSET_HEAD', 'Juego de caracteres usado');
DEFINE ('_UDDEADM_CHARSET_EXP', 'Si tienes problemas mostrando juegos de caracteres no latinos, aqu&iacute; puedes introducir el juego de caracteres que usara uddeIM para convertir la salida de datos de la base de datos a HTML. <b>Si no sabes que significa esto, no cambies el valor por defecto! (Para Castellano el valor por defecto es el correcto)</b>');
DEFINE ('_UDDEADM_MAILCHARSET_HEAD', 'Juego de caracteres usado en correos');
DEFINE ('_UDDEADM_MAILCHARSET_EXP', 'Si tienes problemas mostrando juegos de caracteres no latinos, puedes introducir el juego de caracteres que usara uddeIM para enviar correos. <b>Si no sabes que significa esto, no cambies el valor por defecto! (Para Castellano el valor por defecto es el correcto)</b>');
		// translators info: if you're translating into a language that uses a latin charset
		// (like English, Dutch, German, Swedish, Spanish, ... ) you might want to add a line
		// saying 'For usage in [mylanguage] the default value is correct.'
		
DEFINE ('_UDDEADM_EMN_BODY_NOMESSAGE_EXP', 'Este es el contenido de el correo que los usuarios recibir&aacute;n cuando la opci&oacute;n de arriba este activada. El contenido del mensaje no se incluir&aacute; en el correo. No cambies las variables %you%, %user% y %site%. ');		
DEFINE ('_UDDEADM_EMN_BODY_WITHMESSAGE_EXP', 'Este es el contenido de el correo que los usuarios recibir&aacute;n cuando la opci&oacute;n de arriba este activada. Este correo tendr&aacute; el contenido del mensaje. No cambies las variables %you%, %user%, %pmensaje% y %site%. ');		
DEFINE ('_UDDEADM_EMN_FORGETMENOT_EXP', 'Este es el contenido del correo de recordatorio que los usuarios recibir&aacute;n cuando la opci&oacute;n de arriba este activada. No cambies las variables %you% y %site%. ');		
DEFINE ('_UDDEADM_ENABLEDOWNLOAD_EXP', 'Permitir a los usuarios descargar mensajes de su archivo envi&aacute;ndoselos como correo.');
DEFINE ('_UDDEADM_ENABLEDOWNLOAD_HEAD', 'Permitir descarga');	
DEFINE ('_UDDEADM_EXPORT_FORMAT_EXP', 'Este es el formato del correo que los usuarios recibir&aacute;n cuando se descarguen sus mensajes del archivo. No cambies las variables %user%, %msgdate% y %msgbody%. ');	
		// translators info: Don't translate %you%, %user%, etc. in the strings above. 

DEFINE ('_UDDEADM_INBOXLIMIT_HEAD', 'Activar el limite de la bandeja de entrada');		
DEFINE ('_UDDEADM_INBOXLIMIT_EXP', 'Puedes a&ntilde;adir la cantidad de mensajes en la bandeja de entrada en el numero m&aacute;ximo de mensajes en el archivo. En este caso, el numero total de mensajes de la bandeja de entrada m&aacute;s los de el archivo no exceder&aacute; el numero fijado arriba. Alternativamente puedes fijar el limite de la bandeja de entrada sin un archivo. En este caso, los usuarios no podr&aacute;n tener en sus bandejas de entrada m&aacute;s mensajes que la cantidad fijada arriba. Si esa cantidad es alcanzada, no podr&aacute;n seguir respondiendo a los mensajes o crear nuevos hasta que hayan borrado mensajes de su bandeja de entrada o de su archivo respectivamente. (Los usuarios podr&aacute;n seguir recibiendo mensajes y leerlos.)');
DEFINE ('_UDDEADM_SHOWINBOXLIMIT_HEAD', 'Mostrar el limite de uso en la bandeja de entrada');		
DEFINE ('_UDDEADM_SHOWINBOXLIMIT_EXP', 'Muestra cuantos mensajes tienen los usuarios almacenados (y cuantos pueden almacenar) en una linea debajo de su bandeja de entrada.');
		
DEFINE ('_UDDEADM_ARCHIVETOTRASH_INTRO', 'Has desactivado el archivo. �Que quieres hacer con los mensajes que hay guardados en el archivo?');		

DEFINE ('_UDDEADM_ARCHIVETOTRASH_LEAVE_LINK', 'Dejarlos');		
DEFINE ('_UDDEADM_ARCHIVETOTRASH_LEAVE_EXP', 'Dejarlos en el archivo (el usuario no podr&aacute; acceder a ellos y seguir&aacute;n contando para los limites de los mensajes).');		
DEFINE ('_UDDEADM_ARCHIVETOTRASH_INBOX_LINK', 'Moverlos a la bandeja de entrada');		
DEFINE ('_UDDEADM_ARCHIVETOTRASH_INBOX_DONE', 'Los mensajes archivados ser&aacute;n movidos a las bandejas de entrada');
DEFINE ('_UDDEADM_ARCHIVETOTRASH_INBOX_EXP', 'Los mensajes ser&aacute;n movidos a las bandejas de entradas de sus respectivos usuarios ( o descartados a la papelera si son m&aacute;s antiguos de lo permitido en la bandeja de entrada).');		

		
// 0.4 frontend, admins only (no translation necessary)		
DEFINE ('_UDDEIM_VALIDFOR_1', 'valido para ');
DEFINE ('_UDDEIM_VALIDFOR_2', ' horas. 0=para siempre (los borrados autom&aacute;ticos se aplicaran)');
DEFINE ('_UDDEIM_WRITE_SYSM_GM', '[Crear mensaje de sistema o general]');
DEFINE ('_UDDEIM_WRITE_NORMAL', '[Crear mensaje normal (est&aacute;ndar)]');
DEFINE ('_UDDEIM_NOTALLOWED_SYSM_GM', 'No est&aacute;n permitidos los mensajes de sistema o generales.');
DEFINE ('_UDDEIM_SYSGM_TYPE', 'Tipo de mensaje');
DEFINE ('_UDDEIM_HELPON_SYSGM', 'Ayuda para los mensajes de sistema');
DEFINE ('_UDDEIM_HELPON_SYSGM_2', '(se abre en una nueva ventana)');

DEFINE ('_UDDEIM_SYSGM_PLEASECONFIRM', 'Estas a punto de enviar el mensaje mostrado abajo. Por favor revisalo y confirmalo o cancelalo!');
DEFINE ('_UDDEIM_SYSGM_WILLSENDTOALL', 'Mensaje para <strong>todos los usuarios</strong>');
DEFINE ('_UDDEIM_SYSGM_WILLSENDTOALLADMINS', 'Mensaje para <strong>todos los administradores</strong>');
DEFINE ('_UDDEIM_SYSGM_WILLSENDTOALLLOGGED', 'Mensaje para <strong>todos los usuarios actualmente logeados</strong>');
DEFINE ('_UDDEIM_SYSGM_WILLDISABLEREPLY', 'Los receptores no podr&aacute;n responder a este mensaje.');
DEFINE ('_UDDEIM_SYSGM_WILLSENDAS_1', 'El mensaje sera enviado con <strong>');
DEFINE ('_UDDEIM_SYSGM_WILLSENDAS_2', '</strong> como nombre de usuario');

DEFINE ('_UDDEIM_SYSGM_WILLEXPIRE', 'El mensaje expirar&aacute; ');
DEFINE ('_UDDEIM_SYSGM_WILLNOTEXPIRE', 'El mensaje no expirar&aacute;');
DEFINE ('_UDDEIM_SYSGM_CHECKLINK', '<b>Revisa el enlace (haciendo clic en &eacute;l) antes de seguir!</b>');
DEFINE ('_UDDEIM_SYSGM_SHORTHELP', 'Uso <strong>solo para mensajes de sistema</strong>:<br /> [b]<strong>negrita</strong>[/b] [i]<em>cursiva</em>[/i]<br />
[url=http://www.unenlace.com]un enlace[/url] o [url]http://www.unenlace.com[/url] son enlaces validos');
DEFINE ('_UDDEIM_SYSGM_ERRORNORECIPS', 'Error: No se han encontrado receptores. Mensaje no enviado.');		
		
		
// 0.4 frontend (all users, translation needed)
DEFINE ('_UDDEIM_CANTREPLY', 'No puedes responder a este mensaje.');
DEFINE ('_UDDEIM_EMNOFF', 'La notificaci&oacute;n por correo esta desactivada. ');
DEFINE ('_UDDEIM_EMNON', 'La notificaci&oacute;n por correo esta activada. ');
DEFINE ('_UDDEIM_SETEMNON', '[activarla]');
DEFINE ('_UDDEIM_SETEMNOFF', '[desactivarla]');
DEFINE ('_UDDEIM_EMN_BODY_NOMESSAGE', 'Hola %you%, 

%user% te ha enviado un mensaje privado en %site%.
Por favor accede y leelo!');
DEFINE ('_UDDEIM_EMN_BODY_WITHMESSAGE', 'Hola %you%, 

%user% Te ha enviado el siguiente mensaje en %site%.
Por favor accede para responder al mensaje!
__________________
%pmensaje%
');
DEFINE ('_UDDEIM_EMN_FORGETMENOT', 'Hola %you%,

tienes mensajes privados sin leer en %site%.
Por favor accede y leelos! 
');
DEFINE ('_UDDEIM_EXPORT_FORMAT', '
================================================================================
%user% (%msgdate%)
----------------------------------------
%msgbody%
================================================================================');
DEFINE ('_UDDEIM_EMN_SUBJECT', 'Tienes mensajes en %site%');
DEFINE ('_UDDEIM_SEND_ASSYSM', 'enviar como mensaje del sistema (los receptores no lo podr&aacute;n responder)');
DEFINE ('_UDDEIM_SEND_TOALL', 'enviar a todos los usuarios');
DEFINE ('_UDDEIM_SEND_TOALLADMINS', 'enviar a todos los administradores');
DEFINE ('_UDDEIM_SEND_TOALLLOGGED', 'enviar a todos los usuarios que est&aacute;n en linea');



DEFINE ('_UDDEIM_UNEXPECTEDERROR_QUIT', 'Error inesperado: ');
DEFINE ('_UDDEIM_ARCHIVENOTENABLED', 'El archivo no esta activado.');
DEFINE ('_UDDEIM_ARCHIVE_ERROR', 'El almacenado del mensaje en el archivo ha fallado.');
DEFINE ('_UDDEIM_ARC_SAVED_1', 'Tienes guardados ');
DEFINE ('_UDDEIM_ARC_SAVED_NONE', '<strong>No tienes guardado ning&uacute;n mensaje en el archivo todav&iacute;a.</strong>'); 
DEFINE ('_UDDEIM_ARC_SAVED_2', ' mensajes');
DEFINE ('_UDDEIM_ARC_SAVED_ONE', 'Tienes almacenado un mensaje');
DEFINE ('_UDDEIM_ARC_SAVED_3', 'Para guardar mensajes, tienes que borrar otros mensajes primero.');
DEFINE ('_UDDEIM_ARC_CANSAVEMAX_1', 'Puedes guardar un m&aacute;ximo de ');
DEFINE ('_UDDEIM_ARC_CANSAVEMAX_2', ' mensajes.');
DEFINE ('_UDDEIM_INBOX_LIMIT_1', 'Tienes ');
DEFINE ('_UDDEIM_INBOX_LIMIT_2', ' mensajes en tu');
DEFINE ('_UDDEIM_ARC_UNIVERSE_ARC', 'archivo');
DEFINE ('_UDDEIM_ARC_UNIVERSE_INBOX', 'bandeja de entrada');
DEFINE ('_UDDEIM_ARC_UNIVERSE_BOTH', 'bandeja de entrada y archivo');
DEFINE ('_UDDEIM_INBOX_LIMIT_3', 'El m&aacute;ximo permitido es ');
DEFINE ('_UDDEIM_INBOX_LIMIT_4', 'Tu puedes recibir y leer mensajes pero no podr&aacute;s responderlos o crear nuevos hasta que borres mensajes.');
DEFINE ('_UDDEIM_SHOWINBOXLIMIT_1', 'Mensajes guardados: ');
DEFINE ('_UDDEIM_SHOWINBOXLIMIT_2', '(de un m&aacute;ximo ');

DEFINE ('_UDDEIM_MESSAGE_ARCHIVED', 'Mensaje guardado en el archivo.');
DEFINE ('_UDDEIM_STORE', 'archivar');
		// translators info: as in: 'store this mensaje in archive now'

DEFINE ('_UDDEIM_BACK', 'volver');

DEFINE ('_UDDEIM_TRASHCHECKED', 'descartar seleccionados');
	// translators info: plural!
	
DEFINE ('_UDDEIM_SHOWALL', 'mostrar todos los mensajes');
	// translators example "SHOW ALL mensajes"
	
DEFINE ('_UDDEIM_ARCHIVE', 'Archivo');
	// should be same as _UDDEADM_ARCHIVE
	
DEFINE ('_UDDEIM_ARCHIVEFULL', 'El archivo esta lleno. No se ha guardado.');	
	
DEFINE ('_UDDEIM_NOMSGSELECTED', 'No hay mensajes seleccionados.');
DEFINE ('_UDDEIM_THISISACOPY', 'Copia de el mensaje enviado para ');
DEFINE ('_UDDEIM_SENDCOPYTOME', 'copia para mi');
DEFINE ('_UDDEIM_SENDCOPYTOARCHIVE', 'copia para el archivo');
DEFINE ('_UDDEIM_TRASHORIGINAL', 'descartar el original');

DEFINE ('_UDDEIM_MESSAGEDOWNLOAD', 'Descarga del Mensaje');
DEFINE ('_UDDEIM_EXPORT_MAILED', 'Env&iacute;o del correo con los mensajes exportados');
DEFINE ('_UDDEIM_EXPORT_NOW', 'correo enviado a mi');
DEFINE ('_UDDEIM_EXPORT_MAIL_INTRO', 'Este correo incluye tus mensajes privados.');
DEFINE ('_UDDEIM_EXPORT_COULDNOTSEND', 'No puedo enviar el correo conteniendo los mensajes');

DEFINE ('_UDDEIM_LIMITREACHED', 'Limite del mensaje! No restaurado.');

DEFINE ('_UDDEIM_WRITEMSGTO', 'Escribir un mensaje a ');

$udde_smon[1]="Ene";
$udde_smon[2]="Feb";
$udde_smon[3]="Mar";
$udde_smon[4]="Abr";
$udde_smon[5]="May";
$udde_smon[6]="Jun";
$udde_smon[7]="Jul";
$udde_smon[8]="Ago";
$udde_smon[9]="Sep";
$udde_smon[10]="Oct";
$udde_smon[11]="Nov";
$udde_smon[12]="Dic";

$udde_lmon[1]="Enero";
$udde_lmon[2]="Febrero";
$udde_lmon[3]="Marzo";
$udde_lmon[4]="Abril";
$udde_lmon[5]="Mayo";
$udde_lmon[6]="Junio";
$udde_lmon[7]="Julio";
$udde_lmon[8]="Agosto";
$udde_lmon[9]="Septiembre";
$udde_lmon[10]="Octubre";
$udde_lmon[11]="Noviembre";
$udde_lmon[12]="Diciembre";

$udde_lweekday[0]="Domingo";
$udde_lweekday[1]="Lunes";
$udde_lweekday[2]="Martes";
$udde_lweekday[3]="Miercoles";
$udde_lweekday[4]="Jueves";
$udde_lweekday[5]="Viernes";
$udde_lweekday[6]="Sabado";

$udde_sweekday[0]="Dom";
$udde_sweekday[1]="Lun";
$udde_sweekday[2]="Mar";
$udde_sweekday[3]="Mie";
$udde_sweekday[4]="Jue";
$udde_sweekday[5]="Vie";
$udde_sweekday[6]="Sab";

// new in 0.5 ADMIN

// Translators observe: Search for _UDDEIM_SYSGM_SHORTHELP (above)
// and change this text so that it no longer contains 
// information abouth the [newurl] code. [newurl] is no 
// longer supported by this version of uddeIM.
// already done in this file!
// 
// PLEASE
// When you're done translating, please change the

	// version       0.4+

// at the top of this file into

	// version       0.5

// and delete the line right after it that says

	// (0.4 plus 0.5 strings in English)

// as well as these comments. Thank you.

DEFINE ('_UDDEADM_TEMPLATEDIR_HEAD', 'Plantilla uddeIM');
DEFINE ('_UDDEADM_TEMPLATEDIR_EXP', 'Elije una plantilla para usar con uddeIM');
DEFINE ('_UDDEADM_SHOWCONNEX_HEAD', 'Mostrar conexiones CB');
DEFINE ('_UDDEADM_SHOWCONNEX_EXP', 'Usar <i>s�</i> si tienes Community Builder instalado y quieres presentar al usuario los nombres de sus conexiones al escribir un mensaje.');
DEFINE ('_UDDEADM_SHOWSETTINGSLINK_HEAD', 'Mostrar opciones');
DEFINE ('_UDDEADM_SHOWSETTINGSLINK_EXP', 'El v�nculo a opciones aparece en uddeIM si tienes activadas las notificaciones de e-mail o el bloqueo de usuarios. Si no quieres �sto, lo puedes apagar aqu�. ');
DEFINE ('_UDDEADM_SHOWSETTINGS_ATBOTTOM', 's�, al final');
DEFINE ('_UDDEADM_ALLOWBB_HEAD', 'Permitir BB codes');
DEFINE ('_UDDEADM_FONTFORMATONLY', 'formato de fuentes solamente');
DEFINE ('_UDDEADM_ALLOWBB_EXP', 'Usar <i>formato de fuentes solamente</i> para permitir que los usuarios puedan usar BB codes para negrita, it�lico, subrayado, color de fuente y su tama�o. Cuando eliges <i>s�</i> en esta opci�n, los usuarios pueden usar <strong>todos</strong> los BB codes soportados en sus mensajes (incluso v�nculos e im�genes).');
DEFINE ('_UDDEADM_ALLOWSMILE_HEAD', 'Permitir Emot�conos');
DEFINE ('_UDDEADM_ALLOWSMILE_EXP', 'Cuando se elije <i>s�</i>, los c�digos de emot�conos como :-) se reemplazan con gr�ficos al mostrar el mensaje. Ver el archivo readme para una lista de los emot�conos soportados.');
DEFINE ('_UDDEADM_DISPLAY', 'Mostrar');
DEFINE ('_UDDEADM_SHOWMENUICONS_HEAD', 'Mostrar �conos de Men�');
DEFINE ('_UDDEADM_SHOWMENUICONS_EXP', 'Cuando se elige <i>s�s</i>, los v�nculos de menu y acci�n ser�n mostrados con un �cono.');
DEFINE ('_UDDEADM_SHOWTITLE_HEAD', 'T�tulo del Componente');
DEFINE ('_UDDEADM_SHOWTITLE_EXP', 'Ingrese el t�tulo que tendr� el componente de mensajer�a privada, por ejemplo \'Centro de Mensajes\'. D�jalo vac�o si no quieres mostrar un t�tulo.');
DEFINE ('_UDDEADM_SHOWABOUT_HEAD', 'Mostrar v�nculo \'Acerca de\'');
DEFINE ('_UDDEADM_SHOWABOUT_EXP', 'Elegir <i>s�</i> para mostrar un v�nculo al sitio de uddeIM y su licencia. Este link se ubicar� en el fondo de la salida HTML de uddeIM.');
DEFINE ('_UDDEADM_STOPALLEMAIL_HEAD', 'Para e-mail ahora');
DEFINE ('_UDDEADM_STOPALLEMAIL_EXP', 'Marca esta opci�n para prevenir que uddeIM env�e emails (notificaciones de mensajes y de olvido) sin importar las preferencias de los usuarios, por ejemplo cuando se est� instalando el sitio. Si no quieres esta facilidad nunca, deja todas las opciones de arriba en <i>no</i>.');
DEFINE ('_UDDEADM_ADMINIGNITIONONLY_MANUALLY', 'manualmente');
DEFINE ('_UDDEADM_GETPICLINK_HEAD', 'Miniaturas de CB en las listas');
DEFINE ('_UDDEADM_GETPICLINK_EXP', 'Elige <i>s�</i> si quieres mostrar las miniaturas de CB de los usuarios en las listas de mensajes (bandeja de entarada, de salida, etc.)');

// new in 0.5 FRONTEND

DEFINE ('_UDDEIM_SHOWUSERS', 'Mostrar Usuarios');
DEFINE ('_UDDEIM_CONNECTIONS', 'Conexiones');
DEFINE ('_UDDEIM_SETTINGS', 'Configuraci�n');
DEFINE ('_UDDEIM_NOSETTINGS', 'No hay configuraciones para ajustar.');
DEFINE ('_UDDEIM_ABOUT', 'Acerca de'); // as in "About uddeIM"
DEFINE ('_UDDEIM_COMPOSE', 'Nuevo mensaje'); // as in "write new mensaje", but only one word
DEFINE ('_UDDEIM_EMN', 'Notificaci�n por e-mail');
DEFINE ('_UDDEIM_EMN_EXP', 'Puedes recibir un e-mail cuando un nuevo mensaje te es enviado.');
DEFINE ('_UDDEIM_EMN_ALWAYS', 'Notificaci�n por e-mail para nuevos mensajes');
DEFINE ('_UDDEIM_EMN_NONE', 'Sin notificacion por e-mail');
DEFINE ('_UDDEIM_EMN_WHENOFFLINE', 'Notificaci�n por e-mail cuando estoy desconectado');
DEFINE ('_UDDEIM_EMN_NOTONREPLY', 'No me env�en notificaciones de respuestas');
DEFINE ('_UDDEIM_BLOCKSYSTEM', 'Bloqueo de usuarios'); // Headline for blocking system in settings
DEFINE ('_UDDEIM_BLOCKSYSTEM_EXP', 'Puedes impedir que los usuarios te env�en mensajes bloque�ndolos. Eleg� <i>bloquear usuario</i> cuando ves un mensaje del usuario en cuesti�n.'); // block user is the same as _UDDEIM_BLOCKNOW
DEFINE ('_UDDEIM_SAVECHANGE', 'Guardar cambio');
DEFINE ('_UDDEIM_TOOLTIP_BOLD', 'C�digos BB Code para producir texto en negrita. Uso: [b]negrita[/b]');
DEFINE ('_UDDEIM_TOOLTIP_ITALIC', 'C�digos BB Code para producir texto en it�lico. Uso: [i]it�lico[/i]');
DEFINE ('_UDDEIM_TOOLTIP_UNDERLINE', 'C�digos BB Code para producir texto subrayado. Uso: [u]subrayado[/u]');
DEFINE ('_UDDEIM_TOOLTIP_COLORRED', 'C�digos BB Code para producir texto en colores. Uso:  [color=#XXXXXX]coloreado[/color] donde XXXXXX es el c�digo de color, por ejemplo FF0000 es rojo.');
DEFINE ('_UDDEIM_TOOLTIP_COLORGREEN', 'C�digos BB Code para producir texto en colores. Uso:  [color=#XXXXXX]coloreado[/color] donde XXXXXX es el c�digo de color, por ejemplo 00FF00 es verde.');
DEFINE ('_UDDEIM_TOOLTIP_COLORBLUE', 'C�digos BB Code para producir texto en colores. Uso:  [color=#XXXXXX]coloreado[/color] donde XXXXXX es el c�digo de color, por ejemplo 0000FF es azul.');
DEFINE ('_UDDEIM_TOOLTIP_FONTSIZE1', 'C�digos BB Code para producir texto muy peque�o. Uso: [size=1]Texto muy peque�o.[/size]');
DEFINE ('_UDDEIM_TOOLTIP_FONTSIZE2', 'C�digos BB Code para producir texto peque�o. Uso: [size=2]texto peque�o.[/size]');
DEFINE ('_UDDEIM_TOOLTIP_FONTSIZE4', 'C�digos BB Code para producir texto grande. Uso: [size=4]texto grande.[/size]');
DEFINE ('_UDDEIM_TOOLTIP_FONTSIZE5', 'C�digos BB Code para producir texto muy grande. Uso: [size=5]texto muy grande.[/size]');
DEFINE ('_UDDEIM_TOOLTIP_IMAGE', 'C�digos BB Code para insertar un v�nculo a una imagen. Uso: [img]URL-de-la-imagen[/img]');
DEFINE ('_UDDEIM_TOOLTIP_URL', 'C�digos BB Code para insertar un v�nculo. Uso: [url]direccion-web[/url]. �No olvidar poner el http:// al comienzo de las direcciones web!');
DEFINE ('_UDDEIM_TOOLTIP_CLOSEALLTAGS', 'Cerrar todos los BB codes abiertos.');
DEFINE ('_UDDEIM_INBOX_LIMIT_2_SINGULAR', ' mensaje en tu'); // same as _UDDEIM_INBOX_LIMIT_2, but singular (as in 1 "mensaje in your")
DEFINE ('_UDDEIM_ARC_SAVED_NONE_2', '<strong>No tienes mensajes en tu archivo.</strong>'); 
