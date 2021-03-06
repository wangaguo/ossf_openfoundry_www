﻿<?php
// *******************************************************************
// Title          udde Instant Messages (uddeIM)
// Description    Instant Messages System for Mambo 4.5 / Joomla 1.0 / Joomla 1.5
// Author         © 2007-2008 Stephan Slabihoud, © 2006 Benjamin Zweifel
// License        This is free software and you may redistribute it under the GPL.
//                uddeIM comes with absolutely no warranty.
//                Use at your own risk. For details, see the license at
//                http://www.gnu.org/licenses/gpl.txt
//                Other licenses can be found in LICENSES folder.
// *******************************************************************
// Language file: Brazilian Portuguese (Latin-1)
// Translator:    Ed Blender <edublender@gmail.com>
// *******************************************************************

// New: 1.5
DEFINE ('_UDDEMODULE_ALLDAYS', ' mensagens');
DEFINE ('_UDDEMODULE_7DAYS', ' mensagens nos últimos 7 dias');
DEFINE ('_UDDEMODULE_30DAYS', ' mensagens nos últimos 30 dias');
DEFINE ('_UDDEMODULE_365DAYS', ' mensagens nos últimos 365 dias');
DEFINE ('_UDDEADM_EMN_SENDERMAIL_WARNING', '<br /><b>Nota:<br />Se estiver usando o mosMail, você tem que configurar com um endereço de e-mail válido!</b>');
DEFINE ('_UDDEIM_FILTEREDMESSAGE', 'mensagem filtrada');
DEFINE ('_UDDEIM_FILTEREDMESSAGES', 'mensagens flitradas');
DEFINE ('_UDDEIM_FILTER', 'Filtro:');
DEFINE ('_UDDEIM_FILTER_TITLE_INBOX', 'Apenas deste usuário');
DEFINE ('_UDDEIM_FILTER_TITLE_OUTBOX', 'Apenas para este usuário');
DEFINE ('_UDDEIM_FILTER_UNREAD_ONLY', 'apenas não-lidas');
DEFINE ('_UDDEIM_FILTER_SUBMIT', 'Filtro');
DEFINE ('_UDDEIM_FILTER_ALL', '- tudo -');
DEFINE ('_UDDEIM_FILTER_PUBLIC', '- usuários públicos -');
DEFINE ('_UDDEADM_FILTER_HEAD', 'Ativar Filtro');
DEFINE ('_UDDEADM_FILTER_EXP', 'Se ativado, os usuários podem filtrar suas Caixas de Entrada / Saída para mostrar as mensagens de um remetente ou destinatário.');
DEFINE ('_UDDEADM_FILTER_P0', 'desativado');
DEFINE ('_UDDEADM_FILTER_P1', 'acima da lista de mensagens');
DEFINE ('_UDDEADM_FILTER_P2', 'abaixo da lista de mensagens');
DEFINE ('_UDDEADM_FILTER_P3', 'acima e abaixo da lista de mensagens');
DEFINE ('_UDDEIM_NOMESSAGES_FILTERED', '<b>Você não tem mensagens%s em%s.</b>');	// see next  six lines
DEFINE ('_UDDEIM_NOMESSAGES_FILTERED_UNREAD', ' não-lidas');
DEFINE ('_UDDEIM_NOMESSAGES_FILTERED_FROM', ' deste usuário');
DEFINE ('_UDDEIM_NOMESSAGES_FILTERED_TO', ' para este usuário');
DEFINE ('_UDDEIM_NOMESSAGES_FILTERED_INBOX', ' sua Caixa de Entrada');
DEFINE ('_UDDEIM_NOMESSAGES_FILTERED_OUBOX', ' sua Caixa de Saída');
DEFINE ('_UDDEIM_NOMESSAGES_FILTERED_ARCHIVE', ' seu Arquivo');
DEFINE ('_UDDEIM_TODP_TITLE', 'Destinatário');
DEFINE ('_UDDEIM_TODP_TITLE_CC', 'Um ou mais destinatários (separados por vírgula)');
DEFINE ('_UDDEIM_ADDCCINFO_TITLE', 'Quando marcada, uma linha contendo todos os destinatários será adicionada à mensagem.');
DEFINE ('_UDDEADM_CFGFILE_CONVERTING_2', '...define o padrão para auto-resposta, auto-encaminhar, inputbox, filtro');
DEFINE ('_UDDEADM_AUTORESPONDER_HEAD', 'Ativar Auto-resposta');
DEFINE ('_UDDEADM_AUTORESPONDER_EXP', 'Quando a auto-resposta é ativada o usuário pode habilitar uma notificação de auto-resposta em suas configurações pessoais.');
DEFINE ('_UDDEIM_EMN_AUTORESPONDER', 'Ativar Auto-resposta');
DEFINE ('_UDDEIM_AUTORESPONDER', 'Auto-resposta');
DEFINE ('_UDDEIM_AUTORESPONDER_EXP', 'Quanto a auto-resposta é ativada, cada mensagem recebida será imediatamente respondida.');
DEFINE ('_UDDEIM_AUTORESPONDER_DEFAULT', "Desculpe, no momento eu não estou disponível.\nVou verificar minha caixa postal assim que possível.");
DEFINE ('_UDDEADM_USERSET_AUTOR', 'Auto-R');
DEFINE ('_UDDEADM_USERSET_SELAUTOR', '- Auto-R -');
DEFINE ('_UDDEIM_USERBLOCKED', 'Usuário está bloqueado.');
DEFINE ('_UDDEADM_AUTOFORWARD_HEAD', 'Ativar Auto-encaminhar');
DEFINE ('_UDDEADM_AUTOFORWARD_EXP', 'Quando o auto-encaminhar é ativado, o usuário pode encaminhar novas mensagens para outro usuário, automaticamente.');
DEFINE ('_UDDEIM_EMN_AUTOFORWARD', 'Ativar Auto-encaminhar');
DEFINE ('_UDDEADM_USERSET_AUTOF', 'Auto-E');
DEFINE ('_UDDEADM_USERSET_SELAUTOF', '- Auto-E -');
DEFINE ('_UDDEIM_AUTOFORWARD', 'Auto-encaminhar');
DEFINE ('_UDDEIM_AUTOFORWARD_EXP', 'Novas mensagems podem ser encaminhadas para outro usuário automaticamente.');
DEFINE ('_UDDEIM_THISISAFORWARD', 'Auto-encaminhamento de uma mensagem originalmente enviada para ');
DEFINE ('_UDDEADM_COLSROWS_HEAD', 'Caixa de Mensagem (colunas/linhas)');
DEFINE ('_UDDEADM_COLSROWS_EXP', 'Especifica as colunas e linhas da caixa de mensagem (valores padrão são 60/10).');
DEFINE ('_UDDEADM_WIDTH_HEAD', 'Caixa de Mensagem (largura)');
DEFINE ('_UDDEADM_WIDTH_EXP', 'Especifica a largura da caixa de mensagem, em pixels (o padrão é 0). Se o valor for 0, a largura especificada no arquivo de estilos CSS será usado.');
DEFINE ('_UDDEADM_CBE', 'CB Enhanced');

// New: 1.4
DEFINE ('_UDDEADM_IMPORT_CAPS', 'IMPORTAR');

// New: 1.3
DEFINE ('_UDDEADM_MOOTOOLS_HEAD', 'Carregar MooTools');
DEFINE ('_UDDEADM_MOOTOOLS_EXP', 'Especifica como o uddeIM carrega MooTools (MooTools é requerido pelo Autocompletar): <i>Nenhum</i> é útil quando seus temas carregam MooTools, <i>Auto</i> é recomendado por padrão (da mesma forma que no uddeIM 1.2), quando usando J1.0 você pode também forçar o carregamendo do MooTools 1.1 ou 1.2.');
DEFINE ('_UDDEADM_MOOTOOLS_NONE', 'não carregar MooTools');
DEFINE ('_UDDEADM_MOOTOOLS_AUTO', 'auto');
DEFINE ('_UDDEADM_MOOTOOLS_1', 'forçar carregamendo do MooTools 1.1');
DEFINE ('_UDDEADM_MOOTOOLS_2', 'forçar carregamento do MooTools 1.2');
DEFINE ('_UDDEADM_CFGFILE_CONVERTING_1', '...configuração padrão para o MooTools');
DEFINE ('_UDDEADM_AGORA', 'Agora');

// New: 1.2
DEFINE ('_UDDEADM_CRYPT3', 'Base64 encoded');
DEFINE ('_UDDEADM_TIMEZONE_HEAD', 'Ajustar fuso horário');
DEFINE ('_UDDEADM_TIMEZONE_EXP', 'Quando o uddeIM mostra a hora com erro você pode ajustar o fuso horário nesta configuração. Normalmente, quando tudo está configurado corretamente,  isto deveria estar com zero. Serve para casos em que você precise mudar este valor.');
DEFINE ('_UDDEADM_HOURS', 'horas');
DEFINE ('_UDDEADM_VERSIONCHECK', 'Informação de versão:');
DEFINE ('_UDDEADM_STATISTICS', 'Estatísticas:');
DEFINE ('_UDDEADM_STATISTICS_HEAD', 'Mostrar estatísticas');
DEFINE ('_UDDEADM_STATISTICS_EXP', 'Mostra algumas estatísticas como o número de mensagens armazenadas, etc.');
DEFINE ('_UDDEADM_STATISTICS_CHECK', 'MOSTRAR ESTATÍSTICAS');
DEFINE ('_UDDEADM_MAINTENANCE_COUNT', 'Mensagens armazenadas no banco de dados: ');
DEFINE ('_UDDEADM_MAINTENANCE_COUNT_RECIPIENT', 'Mensagens na Lixeira por destinatário: ');
DEFINE ('_UDDEADM_MAINTENANCE_COUNT_SENDER', 'Mensagens na Lixeira pelo remetente: ');
DEFINE ('_UDDEADM_MAINTENANCE_COUNT_TRASH', 'Mensagens em espera para exclusão: ');
DEFINE ('_UDDEADM_OVERWRITEITEMID_HEAD', 'Sobrepor Itemid');
DEFINE ('_UDDEADM_OVERWRITEITEMID_EXP', 'Normalmente o uddeIM tenta detectar o Itemid correto quando o mesmo não foi definido. Em alguns casos pode ser necessário sobrepor este valor, por exemplo quando você utiliza vários links de menu para o uddeIM.');
DEFINE ('_UDDEADM_OVERWRITEITEMID_CURRENT', 'O Itemid Detectado é: ');
DEFINE ('_UDDEADM_USEITEMID_HEAD', 'Usar Itemid');
DEFINE ('_UDDEADM_USEITEMID_EXP', 'Use este Itemid ao invés do que foi detectado.');
DEFINE ('_UDDEADM_SHOWLINK_HEAD', 'Usar links de perfil');
DEFINE ('_UDDEADM_SHOWLINK_EXP', 'Quando definido com <i>sim</i>, os nomes de usuário exibidos no uddeIM aparecerão como links para o perfil de usuário.');
DEFINE ('_UDDEADM_SHOWPIC_HEAD', 'Mostrar miniaturas');
DEFINE ('_UDDEADM_SHOWPIC_EXP', 'Quando definido com <i>sim</i>, a miniatura do respectivo usuário será exibida durante a leitura de uma mensagem.');
DEFINE ('_UDDEADM_THUMBLISTS_HEAD', 'Mostrar miniaturas em listas');
DEFINE ('_UDDEADM_THUMBLISTS_EXP', 'Definir com <i>sim</i> se você deseja mostrar miniaturas dos usuários durante a visualização de listas de mensagens (entrada, saída, etc.)');
DEFINE ('_UDDEADM_FIREBOARD', 'Fireboard');
DEFINE ('_UDDEADM_CB', 'Community Builder');
DEFINE ('_UDDEADM_DISABLED', 'Desativado');
DEFINE ('_UDDEADM_ENABLED', 'Ativado');
DEFINE ('_UDDEIM_STATUS_FLAGGED', 'Importante');
DEFINE ('_UDDEIM_STATUS_UNFLAGGED', '');
DEFINE ('_UDDEADM_ALLOWFLAGGED_HEAD', 'Permitir marcador de mensagem');
DEFINE ('_UDDEADM_ALLOWFLAGGED_EXP', 'Permite marcação de mensagens (o uddeIM mostra uma estrela em listas que podem ser destacadas para marcar mensagens importantes).');
DEFINE ('_UDDEADM_REVIEWUPDATE', 'Importante: Quando você atualizou o uddeIM de uma versão anterior, por favor leia o README. Às vezes você tem que adicionar ou modificar as tabelas ou campos do banco de dados !');
DEFINE ('_UDDEIM_ADDCCINFO', 'Adicionar linha CC:');
DEFINE ('_UDDEIM_CC', 'CC:');
DEFINE ('_UDDEADM_TRUNCATE_HEAD', 'Abreviar texto citado');
DEFINE ('_UDDEADM_TRUNCATE_EXP', 'Abrevia textos citados em 2/3 do comprimento máximo, caso o comprimento do texto excedida este limite.');
DEFINE ('_UDDEIM_PLUG_INBOXENTRIES', 'Mensagens na Caixa de Entrada ');
DEFINE ('_UDDEIM_PLUG_LAST', 'Última ');
DEFINE ('_UDDEIM_PLUG_ENTRIES', ' mensagens');
DEFINE ('_UDDEIM_PLUG_STATUS', 'Status');
DEFINE ('_UDDEIM_PLUG_SENDER', 'Remetente');
DEFINE ('_UDDEIM_PLUG_MESSAGE', 'Mensagem');
DEFINE ('_UDDEIM_PLUG_EMPTYINBOX', 'Caixa de Entrada Vazia');

// New: 1.1
DEFINE ('_UDDEADM_NOTRASHACCESS_NOT', 'Acesso à lixeira não permitido.');
DEFINE ('_UDDEADM_NOTRASHACCESS_HEAD', 'Restringir acesso à lixeira');
DEFINE ('_UDDEADM_NOTRASHACCESS_EXP', 'Você pode restringir o acesso à lixeira. Normalmente a lixeira é disponível à todos (<i>sem restrição</i>). Você pode restringir o acesso à usuários especiais ou somente à administradores, de modo que grupos com direitos de acesso menor não possam restaurar uma mensagem.');
DEFINE ('_UDDEADM_NOTRASHACCESS_0', 'sem restrição');
DEFINE ('_UDDEADM_NOTRASHACCESS_1', 'usuários especiais');
DEFINE ('_UDDEADM_NOTRASHACCESS_2', 'administradores');
DEFINE ('_UDDEADM_PUBHIDEUSERS_HEAD', 'Ocultar usuários da lista de usuários');
DEFINE ('_UDDEADM_PUBHIDEUSERS_EXP', 'Informe as IDs de usuários que deseja ocultar da lista pública de usuários (ex.: 65,66,67).');
DEFINE ('_UDDEADM_HIDEUSERS_HEAD', 'Ocultar usuários da lista de usuários');
DEFINE ('_UDDEADM_HIDEUSERS_EXP', 'Informe as IDs de usuários que deseja ocultar da lista de usuários (ex.: 65,66,67). Admins sempre vêem a lista completa.');
DEFINE ('_UDDEIM_ERRORCSRF', 'Ataque CSRF reconhecido');
DEFINE ('_UDDEADM_CSRFPROTECTION_HEAD', 'Proteção CSRF');
DEFINE ('_UDDEADM_CSRFPROTECTION_EXP', 'Isto protege todos os formulários de ataques Cross-Site Request Forgery. Isto deve permanecer ativado. Você só tem que desligar isto apenas caso ocorram problemas em seu site.');
DEFINE ('_UDDEIM_CANTREPLYARCHIVE', 'Você não pode responder à mensagens arquivadas.');
DEFINE ('_UDDEIM_COULDNOTRECALLPUBLIC', 'Respostas à usuários não registradros não podem ser executadas.');
DEFINE ('_UDDEADM_PUBREPLYS_HEAD', 'Permitir respostas');
DEFINE ('_UDDEADM_PUBREPLYS_EXP', 'Permitir respostas diretas à mensagens de usuários públicos.');
DEFINE ('_UDDEIM_EMN_BODY_PUBLICWITHMESSAGE',
"Olá %user%,\n\n%you% te enviou a seguinte mensagem privada no %site%.\n__________________\n%pmessage%");
DEFINE ('_UDDEADM_PUBNAMESTEXT', 'Mostrar nomes verdadeiros');
DEFINE ('_UDDEADM_PUBNAMESDESC', 'Mostra nomes verdadeiros ou nomes de usuário no site público?');
DEFINE ('_UDDEIM_USERLIST', 'Lista de Usuário');
DEFINE ('_UDDEIM_YOUHAVETOWAIT', 'Desculpe, você tem que aguardar um pouco antes de poder enviar uma nova mensagem');
DEFINE ('_UDDEADM_USERSET_LASTSENT', 'Última enviada');
DEFINE ('_UDDEADM_TIMEDELAY_HEAD', 'Intervalo de Espera');
DEFINE ('_UDDEADM_TIMEDELAY_EXP', 'Intervalo de tempo, em segundos, que o usuário deve aguardar entre o envio de novas mensagens (0 para nenhum intervalo).');
DEFINE ('_UDDEADM_SECONDS', 'segundos');
DEFINE ('_UDDEIM_PUBLICSENT', 'Mensagem enviada.');
DEFINE ('_UDDEIM_ERRORINFROMNAME', 'Erro no nome do remetente');
DEFINE ('_UDDEIM_ERRORINEMAIL', 'Erro no endereço de e-mail');
DEFINE ('_UDDEIM_YOURNAME', 'Seu nome:');
DEFINE ('_UDDEIM_YOUREMAIL', 'Seu e-mail:');
DEFINE ('_UDDEADM_VERSIONCHECK_USING', 'Você está usando o uddeIM ');
DEFINE ('_UDDEADM_VERSIONCHECK_LATEST', 'Você já está usando a versão mais recente do uddeIM.');
DEFINE ('_UDDEADM_VERSIONCHECK_CURRENT', 'A versão atual é ');
DEFINE ('_UDDEADM_VERSIONCHECK_INFO', 'Informação de atualização:');
DEFINE ('_UDDEADM_VERSIONCHECK_HEAD', 'Verificar atualizações');
DEFINE ('_UDDEADM_VERSIONCHECK_EXP', 'Isto contata o site do desenvolvedor para obter informações sobre a versão atual do uddeIM. Exceto pela versão do uddeIM que você está usando, nenhuma outra informação será transmitida.');
DEFINE ('_UDDEADM_VERSIONCHECK_CHECK', 'VERIFICAR AGORA');
DEFINE ('_UDDEADM_VERSIONCHECK_ERROR', 'Não foi possível receber a informação de versão.');
DEFINE ('_UDDEIM_NOSUCHLIST', 'Lista de Contatos não encontrada!');
DEFINE ('_UDDEIM_LISTSLIMIT_1', 'O número de destinatários excedeu o limite máximo permitido. ');
DEFINE ('_UDDEADM_MAXONLISTS_HEAD', 'Máx. de mensagens');
DEFINE ('_UDDEADM_MAXONLISTS_EXP', 'Máx. de mensagens permitidas por lista de contatos.');
DEFINE ('_UDDEIM_LISTSNOTENABLED', 'Lista de Contatos não foram ativadas');
DEFINE ('_UDDEADM_ENABLELISTS_HEAD', 'Ativar listas de contatos');
DEFINE ('_UDDEADM_ENABLELISTS_EXP', 'O uddeIM permite que usuários criem listas de contatos. Tais listas podem ser usadas para enviar mensagens à múltiplos usuários. Não esqueça de ativar múltiplos destinatários quando você desejar usar as listas de contatos.');
DEFINE ('_UDDEADM_ENABLELISTS_0', 'desativado');
DEFINE ('_UDDEADM_ENABLELISTS_1', 'usuários registrados');
DEFINE ('_UDDEADM_ENABLELISTS_2', 'usuários especiais');
DEFINE ('_UDDEADM_ENABLELISTS_3', 'só administradores');
DEFINE ('_UDDEIM_LISTSNEW', 'Criar nova lista de contatos');
DEFINE ('_UDDEIM_LISTSSAVED', 'Lista de contatos foi salva');
DEFINE ('_UDDEIM_LISTSUPDATED', 'Lista de contato foi atualizada');
DEFINE ('_UDDEIM_LISTSDESC', 'Descrição');
DEFINE ('_UDDEIM_LISTSNAME', 'Nome');
DEFINE ('_UDDEIM_LISTSNAMEWO', 'Nome (sem espaços em branco)');
DEFINE ('_UDDEIM_EDITLINK', 'editar');
DEFINE ('_UDDEIM_LISTS', 'Contatos');
DEFINE ('_UDDEIM_STATUS_READ', 'lida');
DEFINE ('_UDDEIM_STATUS_UNREAD', 'não lida');
DEFINE ('_UDDEIM_STATUS_ONLINE', 'online');
DEFINE ('_UDDEIM_STATUS_OFFLINE', 'offline');
DEFINE ('_UDDEADM_CBGALLERY_HEAD', 'Exibir figuras da Galeria do CB');
DEFINE ('_UDDEADM_CBGALLERY_EXP', 'Por padrão, o uddeIM só exibe avatares de usuários que fizeram upload de avatar. Quando você ativa esta opção, o uddeIM também passa a exibir figuras da galeria de avatares do Community Builder.');
DEFINE ('_UDDEADM_UNBLOCKCB_HEAD', 'Desbloquear Conexões CB');
DEFINE ('_UDDEADM_UNBLOCKCB_EXP', 'Você pode permitir que mensagens à destinatários quando o remetente é um usuário que está na lista de conexões do Community Builder (mesmo que o destinatário esteja num grupo bloqueado). Esta opção é independente do bloqueio individual, que quando ativado, os usuários podem configurar (veja acima).');
DEFINE ('_UDDEIM_GROUPBLOCKED', 'Você não tem permissão para enviar para este grupo.');
DEFINE ('_UDDEIM_ONEUSERBLOCKS', 'O destinatário bloqueou você.');
DEFINE ('_UDDEADM_BLOCKGROUPS_HEAD', 'Grupos bloqueados (usuários registrados)');
DEFINE ('_UDDEADM_BLOCKGROUPS_EXP', 'Grupos aos quais usuários registrados não tem permissão para enviar mensagens. Isto é apenas para usuários registrados. Usuários especiais e administradores não são afetados por esta configuração. Esta opção é independente do bloqueio individual, que quando ativado, os usuários podem configurar (veja acima).');
DEFINE ('_UDDEADM_PUBBLOCKGROUPS_HEAD', 'Grupos bloqueados (usuários públicos)');
DEFINE ('_UDDEADM_PUBBLOCKGROUPS_EXP', 'Grupos aos quais usuários públicos não tem permissão para enviar mensagens. Esta opção é independente do bloqueio individual, que quando ativado, os usuários podem configurar (veja acima). Quando você bloqueia um grupo, usuários desse grupo não podem ver a opção para ativar a exibição pública nas configurações de seus perfis.');
DEFINE ('_UDDEADM_BLOCKGROUPS_1', 'Usuário Público');
DEFINE ('_UDDEADM_BLOCKGROUPS_2', 'Conexão CB');
DEFINE ('_UDDEADM_BLOCKGROUPS_18', 'Usuário Registrado');
DEFINE ('_UDDEADM_BLOCKGROUPS_19', 'Autor');
DEFINE ('_UDDEADM_BLOCKGROUPS_20', 'Editor');
DEFINE ('_UDDEADM_BLOCKGROUPS_21', 'Publicador');
DEFINE ('_UDDEADM_BLOCKGROUPS_23', 'Gerenciador');
DEFINE ('_UDDEADM_BLOCKGROUPS_24', 'Administrador');
DEFINE ('_UDDEADM_BLOCKGROUPS_25', 'Super Administrador');
DEFINE ('_UDDEIM_NOPUBLICMSG', 'Usuário só aceita mensagens de usuários registrados.');
DEFINE ('_UDDEADM_PUBHIDEALLUSERS_HEAD', 'Ocultar da lista pública "Todos os Usuários"');
DEFINE ('_UDDEADM_PUBHIDEALLUSERS_EXP', 'Você pode ocultar certos grupos para que não apareçam na lista pública "Todos os Usuários". Nota: isto oculta só os nomes, os usuários podem continuar recebendo mensagens. Usuários que não ativaram a exibição pública nunca aparecerão listados nesta lista.');
DEFINE ('_UDDEADM_HIDEALLUSERS_HEAD', 'Ocultar da lista "Todos os Usuários"');
DEFINE ('_UDDEADM_HIDEALLUSERS_EXP', 'Você pode ocultar certos grupos para que não apareçam na lista pública "Todos os Usuários". Nota: isto oculta só os nomes, os usuários podem continuar recebendo mensagens.');
DEFINE ('_UDDEADM_HIDEALLUSERS_0', 'nenhum');
DEFINE ('_UDDEADM_HIDEALLUSERS_1', 'apenas super administradores');
DEFINE ('_UDDEADM_HIDEALLUSERS_2', 'apenas administradores');
DEFINE ('_UDDEADM_HIDEALLUSERS_3', 'usuários especiais');
DEFINE ('_UDDEADM_PUBLIC', 'Público');
DEFINE ('_UDDEADM_PUBMODESHOWALLUSERS_HEAD', 'Comportamento do link "Todos os Usuários"');
DEFINE ('_UDDEADM_PUBMODESHOWALLUSERS_EXP', 'Escolha se o link "Todos os Usuários" deve ser omitido do público, ou se sempre será mostrado à todos os usuários.');
DEFINE ('_UDDEADM_USERSET_PUBLIC', 'Site Público');
DEFINE ('_UDDEADM_USERSET_SELPUBLIC', '- selecionar público -');
DEFINE ('_UDDEIM_OPTIONS_F', 'Permitir usuários públicos enviarem mensagem');
DEFINE ('_UDDEIM_MSGLIMITREACHED', 'Foi atingido o limite de mensagens!');
DEFINE ('_UDDEIM_PUBLICUSER', 'Usuário público');
DEFINE ('_UDDEIM_DELETEDUSER', 'Usuário deletado');
DEFINE ('_UDDEADM_CAPTCHALEN_HEAD', 'Tamanho do Captcha');
DEFINE ('_UDDEADM_CAPTCHALEN_EXP', 'Especifica quandos caracteres um usuário deve digitar.');
DEFINE ('_UDDEADM_USECAPTCHA_HEAD', 'Proteção Captcha de spam');
DEFINE ('_UDDEADM_USECAPTCHA_EXP', 'Especifica quem será verificado pelo captcha quando enviando mensagens');
DEFINE ('_UDDEADM_CAPTCHAF0', 'desativado');
DEFINE ('_UDDEADM_CAPTCHAF1', 'apenas usuários públicos');
DEFINE ('_UDDEADM_CAPTCHAF2', 'usuários públicos e registrados');
DEFINE ('_UDDEADM_CAPTCHAF3', 'usuários públicos, registrados e especiais');
DEFINE ('_UDDEADM_CAPTCHAF4', 'todos os usuários (inclusive admins)');
DEFINE ('_UDDEADM_PUBFRONTEND_HEAD', 'Ativar exibição no site');
DEFINE ('_UDDEADM_PUBFRONTEND_EXP', 'Quando ativado, usuários públicos podem enviar mensagens aos usuários registrados (que podem especificar em suas configurações pessoais se desejam usar este recursos).');
DEFINE ('_UDDEADM_PUBFRONTENDDEF_HEAD', 'Padrão de exibição pública');
DEFINE ('_UDDEADM_PUBFRONTENDDEF_EXP', 'Este é o valor padrão que determina se um usuário público pode enviar mensagens aos usuários registrados.');
DEFINE ('_UDDEADM_PUBDEF0', 'desativado');
DEFINE ('_UDDEADM_PUBDEF1', 'ativado');
DEFINE ('_UDDEIM_WRONGCAPTCHA', 'Código de segurança incorreto');

// New: 1.0
DEFINE ('_UDDEADM_NONEORUNKNOWN', 'nenhum ou desconhecido');
DEFINE ('_UDDEADM_DONATE', 'Se você gosta do uddeIM e quer contribuir com o desenvolvedor, por favor faça uma pequena doação.');
// New: 1.0rc2
DEFINE ('_UDDEADM_BACKUPRESTORE_DATE', 'Configuração encontrada no banco de dados: ');
DEFINE ('_UDDEADM_BACKUPRESTORE_HEAD', 'Backup e Restaução de Configuração');
DEFINE ('_UDDEADM_BACKUPRESTORE_EXP', 'Você pode fazer o backup da sua configuração para o banco de dados e restaurá-la quando necessário. Isto é útil quando você atualiza o uddeIM ou quando você quer salvar uma certa configuração, para fins de testes.');
DEFINE ('_UDDEADM_BACKUPRESTORE_BACKUP', 'BACKUP');
DEFINE ('_UDDEADM_BACKUPRESTORE_RESTORE', 'RESTAURAR');
DEFINE ('_UDDEADM_CANCEL', 'Cancelar');
// New: 1.0rc1
DEFINE ('_UDDEADM_LANGUAGECHARSET_HEAD', 'Conjunto de caracteres do arquivo de Idioma');
DEFINE ('_UDDEADM_LANGUAGECHARSET_EXP', 'Normalmente, <strong>padrão</strong> (ISO-8859-1) é para o Joomla 1.0, e <strong>UTF-8</strong> para o Joomla 1.5.');
DEFINE ('_UDDEADM_LANGUAGECHARSET_UTF8', 'UTF-8');
DEFINE ('_UDDEADM_LANGUAGECHARSET_DEFAULT', 'padrão');
DEFINE ('_UDDEIM_READ_INFO_1', 'Mensagens lidas ficarão na Caixa de Entrada por ');
DEFINE ('_UDDEIM_READ_INFO_2', ' dias no máx. antes de serem apagadas automaticamente.');
DEFINE ('_UDDEIM_UNREAD_INFO_1', 'Mensagens não-lidas ficarão na Caixa de Entrada por ');
DEFINE ('_UDDEIM_UNREAD_INFO_2', ' dias no máx. antes de serem apagadas automaticamente.');
DEFINE ('_UDDEIM_SENT_INFO_1', 'Mensagens Enviadas ficarão na Caixa de Entrada por ');
DEFINE ('_UDDEIM_SENT_INFO_2', ' dias no máx. antes de serem apagadas automaticamente.');
DEFINE ('_UDDEADM_DELETEREADAFTERNOTE_HEAD', 'Mostrar aviso para mensagens lidas');
DEFINE ('_UDDEADM_DELETEREADAFTERNOTE_EXP', 'Mostra na Caixa de Entrada o aviso "Mensagens lidas serão apagadas em n dias"');
DEFINE ('_UDDEADM_DELETEUNREADAFTERNOTE_HEAD', 'Mostrar aviso para mensagens não-lidas');
DEFINE ('_UDDEADM_DELETEUNREADAFTERNOTE_EXP', 'Mostra na Caixa de Entrada o aviso "Mensagens não-lidas serão apagadas em n dias"');
DEFINE ('_UDDEADM_DELETESENTAFTERNOTE_HEAD', 'Mostrar aviso para mensagens enviadas');
DEFINE ('_UDDEADM_DELETESENTAFTERNOTE_EXP', 'Mostra na Caixa de Saída o aviso "Mensagens enviadas serão apagadas depois de n dias"');
DEFINE ('_UDDEADM_DELETETRASHAFTERNOTE_HEAD', 'Mostrar aviso para mensagens excluídas');
DEFINE ('_UDDEADM_DELETETRASHAFTERNOTE_EXP', 'Mostra na Lixeira o aviso "Mensagens na lixeira serão excuídas depois de n dias"');
DEFINE ('_UDDEADM_DELETESENTAFTER_HEAD', 'Mensagens enviadas são mantidas por (dias)');
DEFINE ('_UDDEADM_DELETESENTAFTER_EXP', 'Informe o número de dias até que as mensagens <b>enviadas</b> sejam automaticamente apagadas da Caixa de Saída.');
DEFINE ('_UDDEIM_SEND_TOALLSPECIAL', 'enviar à todos os usuários especiais');
DEFINE ('_UDDEIM_SYSGM_WILLSENDTOALLSPECIAL', 'Mensagem para <strong>todos os usuários especiais</strong>');
DEFINE ('_UDDEADM_USERSET_SELUSERNAME', '- selecionar nome de usuário -');
DEFINE ('_UDDEADM_USERSET_SELNAME', '- selecionar nome -');
DEFINE ('_UDDEADM_USERSET_EDITSETTINGS', 'Editar configurações de usuário');
DEFINE ('_UDDEADM_USERSET_EXISTING', 'existente');
DEFINE ('_UDDEADM_USERSET_NONEXISTING', 'não-existente');
DEFINE ('_UDDEADM_USERSET_SELENTRY', '- selecione entrada -');
DEFINE ('_UDDEADM_USERSET_SELNOTIFICATION', '- selecionar notificação -');
DEFINE ('_UDDEADM_USERSET_SELPOPUP', '- selecionar popup -');
DEFINE ('_UDDEADM_USERSET_USERNAME', 'Nome de Usuário');
DEFINE ('_UDDEADM_USERSET_NAME', 'Nome');
DEFINE ('_UDDEADM_USERSET_NOTIFICATION', 'Notificação');
DEFINE ('_UDDEADM_USERSET_POPUP', 'Popup');
DEFINE ('_UDDEADM_USERSET_LASTACCESS', 'Último acesso');
DEFINE ('_UDDEADM_USERSET_NO', 'Não');
DEFINE ('_UDDEADM_USERSET_YES', 'Sim');
DEFINE ('_UDDEADM_USERSET_UNKNOWN', 'desconhecido');
DEFINE ('_UDDEADM_USERSET_WHENOFFLINEEXCEPT', 'Quando offline (exceto respostas)');
DEFINE ('_UDDEADM_USERSET_ALWAYSEXCEPT', 'Sempre (exceto respostas)');
DEFINE ('_UDDEADM_USERSET_WHENOFFLINE', 'Quando offline');
DEFINE ('_UDDEADM_USERSET_ALWAYS', 'Sempre');
DEFINE ('_UDDEADM_USERSET_NONOTIFICATION', 'Sem notificação');
DEFINE ('_UDDEADM_WELCOMEMSG', "Bem-vindo ao uddeIM!\n\nVocê instalou o uddeIM com sucesso.\n\nTente ver esta mensagem com temas diferentes. Você pode configurá-las na interface administrativa do uddeIM.\n\O nuddeIM é um projeto em desenvolvimento. Se você encontrar bugs ou vulnerabilidades, por favor notifique-as para mim, pois juntos nós podemos fazer com que o uddeIM seja melhor.\n\nBoa sorte, e divirta-se!");
DEFINE ('_UDDEADM_UDDEINSTCOMPLETE', 'Instalação do uddeIM completa.');
DEFINE ('_UDDEADM_REVIEWSETTINGS', 'Por favor continue na administração e verifique as configurações.');
DEFINE ('_UDDEADM_REVIEWLANG', 'Caso você esteja rodando o CMS num conjunto de caracteres diferente do ISO 8859-1 certifique-se de ajustar as configurações apropriadamente.');
DEFINE ('_UDDEADM_REVIEWEMAILSTOP', 'Depois da instalação, todo tráfego de e-mail do uddeIM (notificações, lembretes) é desativado então os e-mails não são enviados enquanto você estiver fazendo seus testes. Não se esqueça de desativar a opção "parar e-mail", quando você tiver terminado.');
DEFINE ('_UDDEADM_MAXRECIPIENTS_HEAD', 'Máx. Destinatários');
DEFINE ('_UDDEADM_MAXRECIPIENTS_EXP', 'Número máximo de destinatários permitidos por mensagem (0=ilimitado)');
DEFINE ('_UDDEIM_TOOMANYRECIPIENTS', 'muitos destinatários');
DEFINE ('_UDDEIM_STOPPEDEMAIL', 'Envio de e-mails desativado.');
DEFINE ('_UDDEADM_SEARCHINSTRING_HEAD', 'Pesquisando no texto');
DEFINE ('_UDDEADM_SEARCHINSTRING_EXP', 'O Autocompletar pesquisa dentro do texto (caso contrário, pesquisa apenas do início)');
DEFINE ('_UDDEADM_MODESHOWALLUSERS_HEAD', 'Comportamento do link "Todos os Usuários"');
DEFINE ('_UDDEADM_MODESHOWALLUSERS_EXP', 'Escolha se o link "Todos os Usuários" deve ser ocultado, ou se sempre deve ser exibido para todos os usuários.');
DEFINE ('_UDDEADM_MODESHOWALLUSERS_0', 'Ocultar link "Todos os Usuários"');
DEFINE ('_UDDEADM_MODESHOWALLUSERS_1', 'Mostrar link "Todos os Usuários"');
DEFINE ('_UDDEADM_MODESHOWALLUSERS_2', 'Sempre mostrar todos usuários');
DEFINE ('_UDDEADM_CONFIGNOTWRITEABLE', 'Configuração não é editável:');
DEFINE ('_UDDEADM_CONFIGWRITEABLE', 'Configuração é editável:');
DEFINE ('_UDDEIM_FORWARDLINK', 'encaminhar');
DEFINE ('_UDDEIM_RECIPIENTFOUND', 'destinatário encontrado');
DEFINE ('_UDDEIM_RECIPIENTSFOUND', 'destinatários encontrados');
DEFINE ('_UDDEADM_MAILSYSTEM_MOSMAIL', 'mosMail');
DEFINE ('_UDDEADM_MAILSYSTEM_PHPMAIL', 'php mail (padrão)');
DEFINE ('_UDDEADM_MAILSYSTEM_HEAD', 'Sistema de Correio');
DEFINE ('_UDDEADM_MAILSYSTEM_EXP', 'Selecione o sistema de correio que o uddeIM deve usar para enviar notificações.');
DEFINE ('_UDDEADM_SHOWGROUPS_HEAD', 'Mostrar grupos do Joomla');
DEFINE ('_UDDEADM_SHOWGROUPS_EXP', 'Mostrar grupos do Joomla na lista geral da mensagem.');
DEFINE ('_UDDEADM_ALLOWFORWARDS_HEAD', 'Encaminhamento de mensagens');
DEFINE ('_UDDEADM_ALLOWFORWARDS_EXP', 'Permitir encaminhamento de mensagens.');
DEFINE ('_UDDEIM_FWDFROM', 'Mensagem oiginal de');
DEFINE ('_UDDEIM_FWDTO', 'para');

// New: 0.9+
DEFINE ('_UDDEIM_UNARCHIVE', 'Desarquivar mensagem');
DEFINE ('_UDDEIM_CANTUNARCHIVE', 'Não é possível desarquivar mensagem');
DEFINE ('_UDDEADM_ALLOWMULTIPLERECIPIENTS_HEAD', 'Permitir múltiplos destinatários');
DEFINE ('_UDDEADM_ALLOWMULTIPLERECIPIENTS_EXP', 'Permitir múltiplos destinatários (separados por vírgula).');
DEFINE ('_UDDEIM_CHARSLEFT', 'caracteres restantes');
DEFINE ('_UDDEADM_SHOWTEXTCOUNTER_HEAD', 'Mostrar contador de texto');
DEFINE ('_UDDEADM_SHOWTEXTCOUNTER_EXP', 'Mostra um contador de texto que exibe quantos caracteres restam.');
DEFINE ('_UDDEIM_CLEAR', 'Limpar');
DEFINE ('_UDDEADM_ALLOWMULTIPLEUSER_HEAD', 'Incluir destinatários selecionados na lista');
DEFINE ('_UDDEADM_ALLOWMULTIPLEUSER_EXP', 'Isto permite a seleção de múltiplos destinatários.');
DEFINE ('_UDDEADM_CBALLOWMULTIPLEUSER_HEAD', 'Incluir conexões selecionadas na lista');
DEFINE ('_UDDEADM_CBALLOWMULTIPLEUSER_EXP', 'Isto permite a seleção de múltiplos destinatários.');
DEFINE ('_UDDEADM_PMSFOUND', 'PMS encontrado: ');
DEFINE ('_UDDEIM_ENTERNAME', 'informe um nome');
DEFINE ('_UDDEADM_USEAUTOCOMPLETE_HEAD', 'Usar autocompletar');
DEFINE ('_UDDEADM_USEAUTOCOMPLETE_EXP', 'Use autocompletar para nomes de destinatários.');
DEFINE ('_UDDEADM_OBFUSCATING_HEAD', 'Chave usada para obfuscação');
DEFINE ('_UDDEADM_OBFUSCATING_EXP', 'Digite a chave que é usada para a obfuscação da mensagem. Não mude este valor depois que a obfuscação de mensagem tiver sido ativada.');
DEFINE ('_UDDEADM_CFGFILE_NOTFOUND', 'Arquivo de configuração incorreto encontrado!');
DEFINE ('_UDDEADM_CFGFILE_FOUND', 'Versão encontrada:');
DEFINE ('_UDDEADM_CFGFILE_EXPECTED', 'Versão esperada:');
DEFINE ('_UDDEADM_CFGFILE_CONVERTING', 'Convertendo configuração...');
DEFINE ('_UDDEADM_CFGFILE_DONE', 'Concluído!');
DEFINE ('_UDDEADM_CFGFILE_WRITEFAILED', 'Erro Crítico: falha de escrita no arquivo de configuração:');

// New: 0.8+
DEFINE ('_UDDEIM_ENCRYPTDOWN', 'Mensagem encriptografada! - não é possível fazer download!');
DEFINE ('_UDDEIM_WRONGPASSDOWN', 'Senha incorreta! - não é possível fazer download!');
DEFINE ('_UDDEIM_WRONGPW', 'Senha incorreta! - Por favor contate o administrador do banco de dados!');
DEFINE ('_UDDEIM_WRONGPASS', 'Senha incorreta!');
DEFINE ('_UDDEADM_MAINTENANCE_D1', 'Datas de Lixeira incorretas (Caixa de Entrada/Caixa de Saída): ');
DEFINE ('_UDDEADM_MAINTENANCE_D2', 'Corrigindo datas de Lixeira incorretas');
DEFINE ('_UDDEIM_TODP', 'Para: ');
DEFINE ('_UDDEADM_MAINTENANCE_PRUNE', 'Limpar mensagens agora');
DEFINE ('_UDDEADM_SHOWACTIONICONS_HEAD', 'Mostrar ícones de ação');
DEFINE ('_UDDEADM_SHOWACTIONICONS_EXP', 'Quando definido <i>sim</i>, links de ação serão exibidos com um ícone.');
DEFINE ('_UDDEIM_UNCHECKALL', 'desmarcar tudo');
DEFINE ('_UDDEIM_CHECKALL', 'marcar tudo');
DEFINE ('_UDDEADM_SHOWBOTTOMICONS_HEAD', 'Mostrar ícones abaixo');
DEFINE ('_UDDEADM_SHOWBOTTOMICONS_EXP', 'Quando definido <i>sim</i>, links abaixo serão exibidos com um ícone.');
DEFINE ('_UDDEADM_ANIMATED_HEAD', 'Usar smileys animados');
DEFINE ('_UDDEADM_ANIMATED_EXP', 'Usa smileys animados ao invés de estáticos.');
DEFINE ('_UDDEADM_ANIMATEDEX_HEAD', 'Mais smileys animados');
DEFINE ('_UDDEADM_ANIMATEDEX_EXP', 'Mostra mais smileys animados.');
DEFINE ('_UDDEIM_PASSWORDREQ', 'Mensagem encriptografada - Senha requerida');
DEFINE ('_UDDEIM_PASSWORD', '<strong>Senha requerida</strong>');
DEFINE ('_UDDEIM_PASSWORDBOX', 'Senha');
DEFINE ('_UDDEIM_ENCRYPTIONTEXT', ' (texto de encriptografia)');
DEFINE ('_UDDEIM_DECRYPTIONTEXT', ' (texto de desencriptografia)');
DEFINE ('_UDDEIM_MORE', 'MAIS');
// uddeIM Module
DEFINE ('_UDDEMODULE_PRIVATEMESSAGES', 'Mensagens Privadas');
DEFINE ('_UDDEMODULE_NONEW', 'nenhuma nova');
DEFINE ('_UDDEMODULE_NEWMESSAGES', 'Novas mensagens: ');
DEFINE ('_UDDEMODULE_MESSAGE', 'mensagem');
DEFINE ('_UDDEMODULE_MESSAGES', 'mensegens');
DEFINE ('_UDDEMODULE_YOUHAVE', 'Você tem');
DEFINE ('_UDDEMODULE_HELLO', 'Olá');
DEFINE ('_UDDEMODULE_EXPRESSMESSAGE', 'Mensagem Rápida');

// New: 0.7+
DEFINE ('_UDDEADM_USEENCRYPTION', 'Usar encriptografia');
DEFINE ('_UDDEADM_USEENCRYPTIONDESC', 'Encriptografar mensagens armazenadas');
DEFINE ('_UDDEADM_CRYPT0', 'Nenhum');
DEFINE ('_UDDEADM_CRYPT1', 'Obfuscar mensagens');
DEFINE ('_UDDEADM_CRYPT2', 'Encriptografar mensagens');
DEFINE ('_UDDEADM_NOTIFYDEFAULT_HEAD', 'Padrão para notificação por e-mail');
DEFINE ('_UDDEADM_NOTIFYDEFAULT_EXP', 'Valor padrão para notificação por e-mail (para usuários que ainda não alteraram suas preferências).');
DEFINE ('_UDDEADM_NOTIFYDEF_0', 'Sem notificação');
DEFINE ('_UDDEADM_NOTIFYDEF_1', 'Sempre');
DEFINE ('_UDDEADM_NOTIFYDEF_2', 'Notificação quando desconectado');
DEFINE ('_UDDEADM_SUPPRESSALLUSERS_HEAD', 'Ocultar link "Todos os Usuários"');
DEFINE ('_UDDEADM_SUPPRESSALLUSERS_EXP', 'Ocultar o link "Todos os Usuários" na caixa escrever nova mensagem (útil quando muitos usuários são registrados).');
DEFINE ('_UDDEADM_POPUP_HEAD','Notificação por popup');
DEFINE ('_UDDEADM_POPUP_EXP','Mostra um popup na chegada de uma nova mensagem (mod_uddeim ou o patched mod_cblogin é necessário)');
DEFINE ('_UDDEIM_OPTIONS', 'Mais configurações');
DEFINE ('_UDDEIM_OPTIONS_EXP', 'Aqui você pode ajustar algumas outras configurações.');
DEFINE ('_UDDEIM_OPTIONS_P', 'Mostrar um popup quando uma nova mensagem chegar');
DEFINE ('_UDDEADM_POPUPDEFAULT_HEAD', 'Notificação em popup por padrão');
DEFINE ('_UDDEADM_POPUPDEFAULT_EXP', 'Ativa a notificação em popup por padrão (para usuários que ainda não alteraram suas preferências).');
DEFINE ('_UDDEADM_MAINTENANCE', 'Manutenção');
DEFINE ('_UDDEADM_MAINTENANCE_HEAD', 'Manutenção do banco de dados');
DEFINE ('_UDDEADM_MAINTENANCE_CHECK', 'VERIFICAR');
DEFINE ('_UDDEADM_MAINTENANCE_TRASH', 'REPARAR');
DEFINE ('_UDDEADM_MAINTENANCE_EXP', "Quando um usuário foi apagado suas mensagens normalmente são mantidas no banco de dados. Esta função verifica se é necessário descartar mensagens órfãs e você pode descartá-las se for requisitado.<br />Isto também verifica o banco de dados por alguns erros que então serão corrigidos.");
DEFINE ('_UDDEADM_MAINTENANCE_MC1', "Verificando...<br />");
DEFINE ('_UDDEADM_MAINTENANCE_MC2', "<i>#nnn (Nome de Usuário): [Caixa de Entrada|Entrada na Lixeira|Saída|Saída na Lixeira]</i><br />");
DEFINE ('_UDDEADM_MAINTENANCE_MC3', "<i>Entrada: mensagens armazenadas nas Caixas de Entrada dos usuários</i><br />");
DEFINE ('_UDDEADM_MAINTENANCE_MC4', "<i>Entrada na Lixeira: mensagens das Caixas de Entrada nas Lixeiras dos usuários, mas que continuam na Caixa de Saída de alguém</i><br />");
DEFINE ('_UDDEADM_MAINTENANCE_MC5', "<i>Saida: mensagens armazenadas nas Caixas de Saída dos usuários</i><br />");
DEFINE ('_UDDEADM_MAINTENANCE_MC6', "<i>Saída na Lixeira: mensagens das Caixas de Saída nas Lixeiras dos usuários, mas que continuam na Caixa de Entrada de alguém</i><br />");
DEFINE ('_UDDEADM_MAINTENANCE_MT1', "Reparando...<br />");
DEFINE ('_UDDEADM_MAINTENANCE_NOTFOUND', "Não encontrado (de/para/configurações/bloqueador/bloqueado):");
DEFINE ('_UDDEADM_MAINTENANCE_MT2', "Deletar todas as preferências do usuário");
DEFINE ('_UDDEADM_MAINTENANCE_MT3', "Deletar bloqueio de usuário");
DEFINE ('_UDDEADM_MAINTENANCE_MT4', "Limpar a Caixa de Entrada do usuário deletado, e as respectivas mensagens da Caixa de Saída de remetentes");
DEFINE ('_UDDEADM_MAINTENANCE_MT5', "Limpar a Caixa de Saída do usuário deletado, e as respectivas mensagens da Caixa de Entrada de destinatários");
DEFINE ('_UDDEADM_MAINTENANCE_NOTHINGTODO', '<b>Não há nada à fazer</b><br />');
DEFINE ('_UDDEADM_MAINTENANCE_JOBTODO', '<b>Manutenção requisitada</b><br />');

// New: 0.6+
DEFINE ('_UDDEADM_NAMESTEXT', 'Mostrar nomes verdadeiros');
DEFINE ('_UDDEADM_NAMESDESC', 'Mostrar nomes verdadeiros ou nomes de usuário?');
DEFINE ('_UDDEADM_REALNAMES', 'Nomes Verdadeiros');
DEFINE ('_UDDEADM_USERNAMES', 'Nomes de Usuário');
DEFINE ('_UDDEADM_CONLISTBOX', 'Listbox de conexões');
DEFINE ('_UDDEADM_CONLISTBOXDESC', 'Mostrar minhas conexões num listbox ou numa tabela?');
DEFINE ('_UDDEADM_LISTBOX', 'Listbox');
DEFINE ('_UDDEADM_TABLE', 'Tabela');

DEFINE ('_UDDEIM_TRASHCAN_INFO_1', 'As mensagens ficarão na lixeira por ');
DEFINE ('_UDDEIM_TRASHCAN_INFO_2', ' horas antes de serem apagadas. Você só poderá ver as primeiras palavras da mensagem. Para ler a mensagem completamente você terá que restaurá-la.');
DEFINE ('_UDDEIM_RECALLEDMESSAGE_INFO', 'Esta mensagem esta em modo de edição. Você poderá editá-la e reenviá-la.');
DEFINE ('_UDDEIM_COULDNOTRECALL', 'Esta mensagem não pode ser editada (provavelmente porque foi lida ou apagada.)');
DEFINE ('_UDDEIM_CANTRESTORE', 'Falha ao restaurar mensagem. (é provável que ela tenha sido transferida para a lixeira e depois apagada.)');
DEFINE ('_UDDEIM_COULDNOTRESTORE', 'Falha ao restaurar mensagem.');
DEFINE ('_UDDEIM_DONTSEND', 'Não enviar');
DEFINE ('_UDDEIM_SENDAGAIN', 'Re-enviar');
DEFINE ('_UDDEIM_NOTLOGGEDIN', 'Você não esta logado.');
DEFINE ('_UDDEIM_NOMESSAGES_INBOX', '<strong>Você não tem mensagens em sua Caixa de Entrada.</strong>');
DEFINE ('_UDDEIM_NOMESSAGES_OUTBOX', '<strong>Você não tem mensagens em sua Caixa de Saída.</strong>');
DEFINE ('_UDDEIM_NOMESSAGES_TRASHCAN', '<strong>Você não tem mensagens em sua Lixeira.</strong>');
DEFINE ('_UDDEIM_INBOX', 'Caixa de Entrada');
DEFINE ('_UDDEIM_OUTBOX', 'Caixa de Saída');
DEFINE ('_UDDEIM_TRASHCAN', 'Lixeira');
DEFINE ('_UDDEIM_CREATE', 'Nova mensagem');
DEFINE ('_UDDEIM_UDDEIM', 'Mensagem Privada');
	// this is the headline/name of the component as it appears in Mambo

DEFINE ('_UDDEIM_READSTATUS', 'Lida');
	// as in 'this message has been "read"'

DEFINE ('_UDDEIM_FROM', 'De');
DEFINE ('_UDDEIM_FROM_SMALL', 'de');
DEFINE ('_UDDEIM_TO', 'Para');
DEFINE ('_UDDEIM_TO_SMALL', 'para');
DEFINE ('_UDDEIM_OUTBOX_WARNING', 'Sua Caixa de Saída contém todas as mensagens que você enviou mas que ainda não foram apagadas. Você poderá editar as mensagens na caixa de saída se elas não foram ainda lidas pelo destinatário. Durante a edição ela não será lida pelo destinatário. ');
DEFINE ('_UDDEIM_RECALL', 'editar');
DEFINE ('_UDDEIM_RECALLTHISMESSAGE', 'Editar esta mensagem');
DEFINE ('_UDDEIM_RESTORE', 'Restaurar');
DEFINE ('_UDDEIM_MESSAGE', 'Mensagem');
DEFINE ('_UDDEIM_DATE', 'Data');
DEFINE ('_UDDEIM_DELETED', 'Apagado');
DEFINE ('_UDDEIM_DELETE', 'Apagar');
DEFINE ('_UDDEIM_DELETELINK', 'Apagar');
DEFINE ('_UDDEIM_MESSAGENOACCESS', 'Esta mensagem não pode ser exibida. <br />Possíveis razões:<ul><li>Você não tem permissão para ler essa mensagem privada</li><li>A mensagem foi apagada</li></ul>');
DEFINE ('_UDDEIM_YOUMOVEDTOTRASH', '<b>Você moveu esta mensagem para a lixeira</b>');
DEFINE ('_UDDEIM_MESSAGEFROM', 'Mensagem de ');
DEFINE ('_UDDEIM_MESSAGETO', 'Mensagem sua para ');
DEFINE ('_UDDEIM_REPLY', 'Resposta');
DEFINE ('_UDDEIM_SUBMIT', 'Enviar');
DEFINE ('_UDDEIM_NOMESSAGE', 'Erro: Esta faltando o texto da mensagem! Nenhuma mensagem foi enviada.');
DEFINE ('_UDDEIM_MESSAGE_REPLIEDTO', 'Resposta enviada');
DEFINE ('_UDDEIM_MESSAGE_SENT', 'Mensagem Enviada');
DEFINE ('_UDDEIM_MOVEDTOTRASH', ' e a mensagem original foi movida para a lixeira');
DEFINE ('_UDDEIM_NOSUCHUSER', 'O nome de usuário informado não foi encontrado!');
DEFINE ('_UDDEIM_NOTTOYOURSELF', 'Não é possível enviar mensagem para você mesmo!');
DEFINE ('_UDDEIM_PRUNELINK', 'Somente Admin.: Limpar');
DEFINE ('_UDDEIM_BLOCKS', 'Bloqueado');
DEFINE ('_UDDEIM_YOUAREBLOCKED', 'Não enviado (o usuário o bloqueou)');
DEFINE ('_UDDEIM_BLOCKNOW', 'bloquear&nbsp;usuário');
DEFINE ('_UDDEIM_BLOCKS_EXP', 'Esta é uma lista de usuários bloqueados. Estes usuários não podem enviar mensagens privadas para você.');
DEFINE ('_UDDEIM_NOBODYBLOCKED', 'Você não tem nenhum usuário bloqueado.');
DEFINE ('_UDDEIM_YOUBLOCKED_PRE', 'Você bloqueou atualmente ');
DEFINE ('_UDDEIM_YOUBLOCKED_POST', ' usuário(s).');
DEFINE ('_UDDEIM_UNBLOCKNOW', '[desbloquear]');
DEFINE ('_UDDEIM_BLOCKALERT_EXP_ON', 'Se um usuário bloqueado tentar lhe enviar uma mensagem, ele será informado que você o bloqueou e que a mensagem não pode ser enviada.');
DEFINE ('_UDDEIM_BLOCKALERT_EXP_OFF', 'O usuário bloqueado não poderá saber que você o bloqueou.');
DEFINE ('_UDDEIM_CANTBLOCKADMINS', 'Você não poderá bloquear administradores.');
DEFINE ('_UDDEIM_BLOCKSDISABLED', 'Sistema de Bloqueio não habilitado');
DEFINE ('_UDDEIM_CANTREPLY', 'Você não pode enviar essa mensagem.');
DEFINE ('_UDDEIM_EMNOFF', 'O e-mail de notificação esta desligado. ');
DEFINE ('_UDDEIM_EMNON', 'O e-mail de notificação esta ligado. ');
DEFINE ('_UDDEIM_SETEMNON', '[ligado]');
DEFINE ('_UDDEIM_SETEMNOFF', '[desligado]');
DEFINE ('_UDDEIM_EMN_BODY_NOMESSAGE', 'Olá %you%,

%user% lhe enviou uma mensagem privada em %site%.
Por favor é preciso estar logado para ler a mensagem!');
DEFINE ('_UDDEIM_EMN_BODY_WITHMESSAGE', 'Olá %you%,

%user% lhe enviou a seguinte mensagem privada %site%.
Por favor é preciso estar logado para responder a mensagem!
__________________
%pmessage%
');
DEFINE ('_UDDEIM_EMN_FORGETMENOT', 'Olá %you%,

você tem mensagens privadas não lidas em %site%.
Por favor faça o seu login para visualiza-la!
');
DEFINE ('_UDDEIM_EXPORT_FORMAT', '
================================================================================
%user% (%msgdate%)
----------------------------------------
%msgbody%
================================================================================');
DEFINE ('_UDDEIM_EMN_SUBJECT', 'Você tem mensagens no %site%');





DEFINE ('_UDDEIM_ARCHIVE_ERROR', 'Falha ao tentar arquivar mensagem.');
DEFINE ('_UDDEIM_ARC_SAVED_NONE', '<strong>Você não tem nenhuma mensagem arquivada.</strong>');
DEFINE ('_UDDEIM_ARC_SAVED_1', 'Você arquivou ');
DEFINE ('_UDDEIM_ARC_SAVED_2', ' mensagens');
DEFINE ('_UDDEIM_ARC_SAVED_ONE', 'Você arquivou uma mensagem');
DEFINE ('_UDDEIM_ARC_SAVED_3', 'Para salvar essa mensagem você terá que primeiro apagar outra.');
DEFINE ('_UDDEIM_ARC_CANSAVEMAX_1', 'Você pode salvar no máximo ');
DEFINE ('_UDDEIM_ARC_CANSAVEMAX_2', ' mensagens.');

DEFINE ('_UDDEIM_INBOX_LIMIT_1', 'Você tem ');
DEFINE ('_UDDEIM_INBOX_LIMIT_2', ' mensagens em seu');
DEFINE ('_UDDEIM_ARC_UNIVERSE_ARC', 'arquivo');
DEFINE ('_UDDEIM_ARC_UNIVERSE_INBOX', 'Caixa de entrada');
DEFINE ('_UDDEIM_ARC_UNIVERSE_BOTH', 'Caixa de entrada e arquivo');
	// The lines above are to make up a sentence like
	// "You have | 126 | messages in your | inbox and archive"

DEFINE ('_UDDEIM_INBOX_LIMIT_3', 'O máximo permitido é ');
DEFINE ('_UDDEIM_INBOX_LIMIT_4', 'Você ainda pode receber e ler mensagens mas não poderá responder ou escrever até que você apague alguma mensagem antiga.');
DEFINE ('_UDDEIM_SHOWINBOXLIMIT_1', 'Mensagens arquivadas: ');
DEFINE ('_UDDEIM_SHOWINBOXLIMIT_2', '(no max. ');
	// don't add closing bracket

DEFINE ('_UDDEIM_MESSAGE_ARCHIVED', 'Mensagens guardadas no arquivo.');
DEFINE ('_UDDEIM_STORE', 'arquivo');
	// translators info: as in: 'store this message in archive now'

DEFINE ('_UDDEIM_BACK', 'voltar');

DEFINE ('_UDDEIM_TRASHCHECKED', 'confirmando exclusão de');
	// translators info: plural! (as in "delete checked" messages)
	
DEFINE ('_UDDEIM_SHOWALL', 'exibir todas');
	// translators example "SHOW ALL messages"
	
DEFINE ('_UDDEIM_ARCHIVE', 'Arquivo');
	// should be same as _UDDEADM_ARCHIVE
	
DEFINE ('_UDDEIM_ARCHIVEFULL', 'O arquivo esta cheio. Não foi possível salvar.');
	
DEFINE ('_UDDEIM_NOMSGSELECTED', 'Nenhuma mensagem selecionada.');
DEFINE ('_UDDEIM_THISISACOPY', 'Copia da mensagem enviada para ');
DEFINE ('_UDDEIM_SENDCOPYTOME', 'copia para mim');
	// as in 'send a "copy to me"' or cc: me

DEFINE ('_UDDEIM_SENDCOPYTOARCHIVE', 'copiar para o arquivo');
DEFINE ('_UDDEIM_TRASHORIGINAL', 'lixo original');

DEFINE ('_UDDEIM_MESSAGEDOWNLOAD', 'Download da Mensagem');
DEFINE ('_UDDEIM_EXPORT_MAILED', 'E-mail com mensagens exportadas');
DEFINE ('_UDDEIM_EXPORT_NOW', 'e-mail de confrmação para mim');
	// as in "send the messages checked above by E-Mail to me"

DEFINE ('_UDDEIM_EXPORT_MAIL_INTRO', 'Esta e-mail contém sua mensaem privada.');
DEFINE ('_UDDEIM_EXPORT_COULDNOTSEND', 'Não é possível enviar e-mails que contenham mensagens.');

DEFINE ('_UDDEIM_LIMITREACHED', 'Limite da mensagem! Não restaurado.');

DEFINE ('_UDDEIM_WRITEMSGTO', 'Escrever mensagem para ');
	// as in "write a message to" (a person)

// months and weeknames (please translate according 
// to your language)

$udde_smon[1]="Jan";
$udde_smon[2]="Fev";
$udde_smon[3]="Mar";
$udde_smon[4]="Abr";
$udde_smon[5]="Mai";
$udde_smon[6]="Jun";
$udde_smon[7]="Jul";
$udde_smon[8]="Ago";
$udde_smon[9]="Set";
$udde_smon[10]="Out";
$udde_smon[11]="Nov";
$udde_smon[12]="Dez";

$udde_lmon[1]="Janeiro";
$udde_lmon[2]="Fevereiro";
$udde_lmon[3]="Março";
$udde_lmon[4]="Abril";
$udde_lmon[5]="Mai";
$udde_lmon[6]="Junho";
$udde_lmon[7]="Julho";
$udde_lmon[8]="Augosto";
$udde_lmon[9]="Setembro";
$udde_lmon[10]="Outubro";
$udde_lmon[11]="Novembro";
$udde_lmon[12]="Dezembro";

$udde_lweekday[0]="Domingo";
$udde_lweekday[1]="Segunda";
$udde_lweekday[2]="Terça";
$udde_lweekday[3]="Quarta";
$udde_lweekday[4]="Quinta";
$udde_lweekday[5]="Sexta";
$udde_lweekday[6]="Sábado";

$udde_sweekday[0]="Dom";
$udde_sweekday[1]="Seg";
$udde_sweekday[2]="Ter";
$udde_sweekday[3]="Qua";
$udde_sweekday[4]="Qui";
$udde_sweekday[5]="Sex";
$udde_sweekday[6]="Sab";

// *********************************************************
// the following can remain English
// *********************************************************

DEFINE ('_UDDEIM_NOID', 'Erro: Não foi encontrado o ID do destinatário. Nenhuma mensagem enviada.');
DEFINE ('_UDDEIM_VIOLATION', '<b>Violação de acesso!</b> Você não tem permissão para executar essa ação!');
DEFINE ('_UDDEIM_UNEXPECTEDERROR_QUIT', 'Erro inesperado: ');
DEFINE ('_UDDEIM_ARCHIVENOTENABLED', 'Arquivo não habilitado.');


// *********************************************************
// No translation necessary below this line
// *********************************************************

DEFINE ('_UDDEIM_ONLINEPIC', 'images/icon_online.gif');
DEFINE ('_UDDEIM_OFFLINEPIC', 'images/icon_offline.gif');

// Admin

DEFINE ('_UDDEADM_SETTINGS', 'Administração do uddeIM');
DEFINE ('_UDDEADM_GENERAL', 'Geral');
DEFINE ('_UDDEADM_ABOUT', 'Sobre');
DEFINE ('_UDDEADM_DATESETTINGS', 'Data/hora');
DEFINE ('_UDDEADM_PICSETTINGS', 'Ícones');
DEFINE ('_UDDEADM_DELETEREADAFTER_HEAD', 'Mensagens lidas são mantidas por (dias)');
DEFINE ('_UDDEADM_DELETEUNREADAFTER_HEAD', 'Mensagens que não foram lidas são mantidas por (dias)');
DEFINE ('_UDDEADM_DELETETRASHAFTER_HEAD', 'Mensagens na lixeira são mantidas por (dias)');
DEFINE ('_UDDEADM_DAYS', 'dia(s)');
DEFINE ('_UDDEADM_DELETEREADAFTER_EXP', 'Defina o número de dias em que as mensagens que já foram lidas deverão ser apagadas automaticamente da caixa de entrada. Se você não deseja que as mensagens sejam apagadas automaticamente, defina um valor alto (por exemplo, 36524 dias equivale a um século). Mas esteja atento que o banco de dados poderá ficar muito cheio caso as mensagens não sejam apagadas.');
DEFINE ('_UDDEADM_DELETEUNREADAFTER_EXP', 'Defina o número de dias em que as mensagens <b>não lidas</b>, pelos destinatários, devem ser apagadas automaticamente.');
DEFINE ('_UDDEADM_DELETETRASHAFTER_EXP', 'Defina o número de dias para que as mensagens sejam apagadas da lixeira automaticamente. Valores menores que 1 também são aceitos. Por Exemplo: para que as mensagens sejam apagadas da lixeira após 3 horas, basta preencher com o número 0.125.');
DEFINE ('_UDDEADM_DATEFORMAT_HEAD', 'Exibir o formato de data');
DEFINE ('_UDDEADM_DATEFORMAT_EXP', 'Escolha o formato de data/hora que será exibido juntamente com a mensagem. Meses serão abreviados de acordo com sua opção de idioma que esta sendo utilizado pelo Joomla (caso exista o arquivo de idioma do uddeIM correspondente).');
DEFINE ('_UDDEADM_LDATEFORMAT_HEAD', 'formato longo de exibição da data');
DEFINE ('_UDDEADM_LDATEFORMAT_EXP', 'Escolha o formato da data que será exibida ao abrir a mensagem. Para semanas e meses, será usado o padrão utilizado pelo mambo (se existir um arquivo de idiomas do uddeIM correspondente ao utilizado pelo Joomla).');
DEFINE ('_UDDEADM_ADMINIGNITIONONLY_HEAD', 'Deleção Invocada');
DEFINE ('_UDDEADM_ADMINIGNITIONONLY_YES', 'apenas por administradores');
DEFINE ('_UDDEADM_ADMINIGNITIONONLY_NO', 'por qualquer usuário');
DEFINE ('_UDDEADM_ADMINIGNITIONONLY_EXP', 'Deleções automáticas impõem uma carga pesada nos servidores e bancos de dados. Se você escolher <i>apenas por administradores</i> as deleções automáticas conforme as configurações acima (das mensagens de todos os usuários) são invocadas quando qualquer administrador verificar a Caixa de Entrada dele. Escolha esta opção se um administrador está verificando a Caixa de Entrada uma vez por dia ou com mais frequência, que é o caso de muitos sites. (Se seu site tem mais do que um administrador, não importa qual deles efetua o login, uma vez que as deleções são invocadas por qualquer administrador.) Em sites muito pequenos ou sites onde os administradores raramente verificam suas Caixas de Entrada, escolha <i>por qualquer usuário</i>. Se você não compreendeu isto, ou não sabe o que fazer, escolha <i>por qualquer usuário</i>.');
DEFINE ('_UDDEADM_SAVESETTINGS', 'Salvar Configuração');
DEFINE ('_UDDEADM_THISHASBEENSAVED', 'A configuração foi salva no arquivo config:');
DEFINE ('_UDDEADM_SETTINGSSAVED', 'As configurações foram salvas.');
DEFINE ('_UDDEADM_ICONONLINEPIC_HEAD', 'Ícone: Usuário está online');
DEFINE ('_UDDEADM_ICONONLINEPIC_EXP', 'Digite o endereço da localização do ìcone, que será exibido quando o usuário estiver online.');
DEFINE ('_UDDEADM_ICONOFFLINEPIC_HEAD', 'Ìcone: Usuário esta offline');
DEFINE ('_UDDEADM_ICONOFFLINEPIC_EXP', 'Digite o endereço da localização do ícone, que será exibido quando o usuário estiver offline.');
DEFINE ('_UDDEADM_ICONREADPIC_HEAD', 'Ícone: Mensagem Lida');
DEFINE ('_UDDEADM_ICONREADPIC_EXP', 'Digite o endereço da localização do ícone, que será exibido para Mensagens Lidas.');
DEFINE ('_UDDEADM_ICONUNREADPIC_HEAD', 'Ícone: Mensagem não Lida');
DEFINE ('_UDDEADM_ICONUNREADPIC_EXP', 'Digite o endereço da localização do ìcone, que será exibido para Mensagens não Lidas.');
DEFINE ('_UDDEADM_MODULENEWMESS_HEAD', 'Módulo: Ícone Mensagens Novas');
DEFINE ('_UDDEADM_MODULENEWMESS_EXP', 'Esta configuração se refere ao módulo mod_uddeim_new. Digite a localização desse ícone, que será exibido quando houver mensagens novas.');
DEFINE ('_UDDEADM_UDDEINSTALL', 'Instalação do uddeIM');
DEFINE ('_UDDEADM_FINISHED', 'A Instalação foi finalizada. Seja Bem-vindo ao uddeIM. ');
DEFINE ('_UDDEADM_NOCB', '<span style="color: red;">Você não tem o Mambo Community Builder instalado. Você não poderá usar uddeIM.</span><br /><br />Você poderá fazer download no endereço: <a href="http://www.mambojoe.com">Mambo Community Builder</a>.');
DEFINE ('_UDDEADM_CONTINUE', 'continue');
DEFINE ('_UDDEADM_PMSFOUND_1', 'Há ');
DEFINE ('_UDDEADM_PMSFOUND_2', ' mensagens em seu PMS. Você deseja importa-las para o uddeIM?');
DEFINE ('_UDDEADM_IMPORT_EXP', 'Isto não alterará as mensagens de PMS e a sua instalação eles permanecerão intactos. Você poderá importar com segurança para o uddeIM e manter o PMS funcionando se desejar. (Você deverá primeiramete salvar as alterações e a configuração antes da promover a importação!) As mensagens que estão no Banco de Dados do uddeIM ficarão intactas.');
DEFINE ('_UDDEADM_IMPORT_YES', 'Importar mensagens do PMS para o uddeIM agora');
DEFINE ('_UDDEADM_IMPORT_NO', 'Não, não importe nenhuma mensagem');
DEFINE ('_UDDEADM_IMPORTING', 'Aguarde as mensagens estão sendo importadas.');
DEFINE ('_UDDEADM_IMPORTDONE', 'Concluída a importação das mensagens do PMS. Não rode esse script novamente caso contrário as mensagens ficarão duplicadas.');
DEFINE ('_UDDEADM_IMPORT', 'Importar');
DEFINE ('_UDDEADM_IMPORT_HEADER', 'Importar mensagens do PMS');
DEFINE ('_UDDEADM_PMSNOTFOUND', 'Não encontramos o PMS instalado. Importação imporssível.');
DEFINE ('_UDDEADM_ALREADYIMPORTED', '<span style="color: red;">Você já importou as mensagens do PMS para o uddeIM.</span>');
DEFINE ('_UDDEADM_BLOCKSYSTEM_HEAD', 'Habilitar o sistema de bloqueio');
DEFINE ('_UDDEADM_BLOCKSYSTEM_EXP', 'Quando estiver habilitado, os usuários terão permissão para bloquear outros usuários. O usuário bloqueado não poderá enviar mensagens para o usuário que o bloqueou. Administradores não podem ser bloqueados.');
DEFINE ('_UDDEADM_BLOCKSYSTEM_YES', 'sim');
DEFINE ('_UDDEADM_BLOCKSYSTEM_NO', 'não');
DEFINE ('_UDDEADM_BLOCKALERT_HEAD', 'Notificar o usuário que foi bloqueado');
DEFINE ('_UDDEADM_BLOCKALERT_EXP', 'Se você selecionar <i>sim</i>, o usuário bloqueado será notificado de que não poderá enviar a mensagem porque o destinatário o bloqueou. Se for selecionada a opção <i>não</i>, o usuário bloqueado não será notificado que a mensagem não foi enviada.');
DEFINE ('_UDDEADM_BLOCKALERT_YES', 'sim');
DEFINE ('_UDDEADM_BLOCKALERT_NO', 'não');
DEFINE ('_UDDEADM_DELETIONS', 'Exclusão');
DEFINE ('_UDDEADM_BLOCK', 'Bloqueando');
DEFINE ('_UDDEADM_INTEGRATION', 'Integração');
DEFINE ('_UDDEADM_EMAIL', 'E-mail');
DEFINE ('_UDDEADM_SHOWCBLINK_HEAD', 'Exibir links do CB');
DEFINE ('_UDDEADM_SHOWCBLINK_EXP', 'Ao selecionar <i>sim</i>, o perfil de todos os usuários será exibido no uddeIM através de um link do Community Builder.');
DEFINE ('_UDDEADM_SHOWCBPIC_HEAD', 'Exibir thumbnail do CB');
DEFINE ('_UDDEADM_SHOWCBPIC_EXP', 'Ao selecionar <i>sim</i>, o thumbnail do respectivo usuário será exibido quando a mensagem for lida (se o usuário possuir uma imagem no perfil do Community Builder).');
DEFINE ('_UDDEADM_SHOWONLINE_HEAD', 'Exibir status online');
DEFINE ('_UDDEADM_SHOWONLINE_EXP', 'Ao selecionar <i>sim</i>, o uddeIM exibe todos o  nomes de usuários através de um ícone pequeno que informará se o usuário esta on-line ou offline. Você poderá definir a imagem dos ícone no painel de controle do administrador.');
DEFINE ('_UDDEADM_ALLOWEMAILNOTIFY_HEAD', 'Permitir e-mail de notificação');
DEFINE ('_UDDEADM_ALLOWEMAILNOTIFY_EXP', 'Ao selecionar <i>sim</i>, todos os usuários poderão escolher se desejam receber um e-mail de notificação ao receber uma mensagem.');
DEFINE ('_UDDEADM_EMAILWITHMESSAGE_HEAD', 'O E-mail contem a mensagem');
DEFINE ('_UDDEADM_EMAILWITHMESSAGE_EXP', 'Ao selecionar <i>não</i>, este e-mail somente conterá informaçõs resumidas de quando e quem enviou a mensagem.');
DEFINE ('_UDDEADM_LONGWAITINGEMAIL_HEAD', 'E-mail de Lembrete');
DEFINE ('_UDDEADM_LONGWAITINGEMAIL_EXP', 'Este recurso envia um e-mail aos usuários que têm mensagens não-lidas na Caixa de Entrada, já há bastante tempo (defina abaixo). Esta opção é independente da "permitir notificação por e-mail". Se você não quer enviar quaisquer mensagens de e-mail, então deve desativar ambas as opções.');
DEFINE ('_UDDEADM_LONGWAITINGDAYS_HEAD', 'Lembrete enviado após dia(s)');
DEFINE ('_UDDEADM_LONGWAITINGDAYS_EXP', 'Se o recurso Lembrete (acima) está com <i>sim</i>, defina em quantos dias deverá ser enviado o e-mail informando sobre as mensagens não-lidas.');
DEFINE ('_UDDEADM_FIRSTWORDSINBOX_HEAD', 'Lista de caracteres iniciais');
DEFINE ('_UDDEADM_FIRSTWORDSINBOX_EXP', 'Você poderá determinar aqui quantos caracteres podem ser exibidos na caixa de entrada, na caixa de saída e na lixeira.');
DEFINE ('_UDDEADM_MAXLENGTH_HEAD', 'Comprimento máximo da mensagem');
DEFINE ('_UDDEADM_MAXLENGTH_EXP', 'Selecione aqui o comprimento máximo da mensagem. Ela será removida automaticamente após. Selecione  "0" para permitir o comprimento máximo da mensagem (não ecomendado).');
DEFINE ('_UDDEADM_YES', 'sim');
DEFINE ('_UDDEADM_NO', 'não');
DEFINE ('_UDDEADM_ADMINSONLY', 'somente admins');
DEFINE ('_UDDEADM_SYSTEM', 'Sistema');
DEFINE ('_UDDEADM_SYSM_USERNAME_HEAD', 'Nome de Usuário em Mensagens de Sistema');
DEFINE ('_UDDEADM_SYSM_USERNAME_EXP', 'O uddeIM suporta mensagens de sistema. Elas não tem um remetente visível e os usuários não podem responder estas mensagens. Informe aqui o apelido do nome de usuário padrão para as mensagens de sistema (por exemplo <i>Suporte</i> ou <i>Central de Ajuda</i> ou <i>Mestre da Comunidade</i>)');
DEFINE ('_UDDEADM_ALLOWTOALL_HEAD', 'Permitir que os administradores enviem mensagens gerais');
DEFINE ('_UDDEADM_ALLOWTOALL_EXP', 'O uddeIM suporta mensagens gerais. Elas são enviadas para cada usuário no seu sistema. Use-as moderadamente, sem exageros.');
DEFINE ('_UDDEADM_EMN_SENDERNAME_HEAD', 'Nome do remetente do e-mail');
DEFINE ('_UDDEADM_EMN_SENDERNAME_EXP', 'Digite o nome que será exibido no e-mail de notificação. (Por exemplo <i>Nome do  seu Site</i>)');
DEFINE ('_UDDEADM_EMN_SENDERMAIL_HEAD', 'Endereço do remetente do E-mail');
DEFINE ('_UDDEADM_EMN_SENDERMAIL_EXP', 'Digite o endereço de e-mail que será exibido no e-mail de notificação (pode ser o endereço de contato do seu site.');
DEFINE ('_UDDEADM_VERSION', 'Versão do uddeIM');
DEFINE ('_UDDEADM_ARCHIVE', 'Arquivo'); // translators info: headline for Archive system
DEFINE ('_UDDEADM_ALLOWARCHIVE_HEAD', 'Habilitar arquivo');
DEFINE ('_UDDEADM_ALLOWARCHIVE_EXP', 'Escolha se os usuários terão permissão para arquivar as mensagens. Mensagens arquivadas não serão apagadas.');
DEFINE ('_UDDEADM_MAXARCHIVE_HEAD', 'Max de mensagens no arquivo do usuário');
DEFINE ('_UDDEADM_MAXARCHIVE_EXP', 'Defina quantas mensagens podem ser arquivadas (não haverá limites para os administradores).');
DEFINE ('_UDDEADM_COPYTOME_HEAD', 'Permitir cópia');
DEFINE ('_UDDEADM_COPYTOME_EXP', 'Permitir que os usuários recebam cópia das mensagens enviadas. As cópias irão para a caixa de entrada.');
DEFINE ('_UDDEADM_MESSAGES', 'Mensagens');
DEFINE ('_UDDEADM_TRASHORIGINAL_HEAD', 'Enviar para a lixeira mensagens respondidas');
DEFINE ('_UDDEADM_TRASHORIGINAL_EXP', 'Quando ativado, a opção "Enviar para a lixeira mensagens respondidas" é a padrão. Nesse caso, a mensagem será movida da caixa de entrada para a lixeira após ser respondida. Esta opção reduz o número de mensagens no banco de Dados. Os usuários poderão desmarcar essa opção para que as mensagens permaneçam na Caixa de Entrada.');
	// translators info: 'Send' is the same as _UDDEIM_SUBMIT, 
	// and 'trash original' the same as _UDDEIM_TRASHORIGINAL
DEFINE ('_UDDEADM_PERPAGE_HEAD', 'Messagens por página');
DEFINE ('_UDDEADM_PERPAGE_EXP', 'Defina aqui o número de mensagens exibidas por página na caixa de Entrada, caixa de Saída, Lixeira e arquivo.');
DEFINE ('_UDDEADM_CHARSET_HEAD', 'Caractere usado');
DEFINE ('_UDDEADM_CHARSET_EXP', 'Se você está tendo problemas de exibição de caracteres não-latinos, você pode informar aqui qual charset que o uddeIM usará para converter a saída do bando de dados para o código HTML. <b>Se você não sabe o que isso significa, não modifique o valor padrão!</b>');
DEFINE ('_UDDEADM_MAILCHARSET_HEAD', 'Charset usado no e-mail');
DEFINE ('_UDDEADM_MAILCHARSET_EXP', 'Se você está tendo problemas de exibição de caracteres não-latinos, você pode indormar aqui qual charset que o uddeIM usará para enviar e-mails. <b>Se você não sabe o que isso significa, não modifique o valor padrão!</b>');
		// translators info: if you're translating into a language that uses a latin charset
		// (like English, Dutch, German, Swedish, Spanish, ... ) you might want to add a line
		// saying 'For usage in [mylanguage] the default value is correct.'
DEFINE ('_UDDEADM_EMN_BODY_NOMESSAGE_EXP', 'Esse é o conteúdo do e-mail que o usuário receberá quando essa opção for selecionada. O conteúdo da mensagem não estará no e-mail. Mantenha as variáveis %you%, %user% e %site% intactas. ');
DEFINE ('_UDDEADM_EMN_BODY_WITHMESSAGE_EXP', 'Esse é o conteúdo do e-mail que o usuário receberá quando essa opção for selecionada. Este e-mail não será incluído no conteúdo da mensagem. Mantenha as variáveis %you%, %user%, %pmessage% e %site% intactas. ');
DEFINE ('_UDDEADM_EMN_FORGETMENOT_EXP', 'Esse é o conteúdo do e-mail de lembrete que o usuário receberá quando a opção for selecionada. Mantenha as variáveis %you% e %site% intactas. ');		
DEFINE ('_UDDEADM_ENABLEDOWNLOAD_EXP', 'Permitir aos usuários fazer o download das suas mensagens arquivadas, ao enviá-las por e-mail deles para eles mesmos.');
DEFINE ('_UDDEADM_ENABLEDOWNLOAD_HEAD', 'Permitir download');
DEFINE ('_UDDEADM_EXPORT_FORMAT_EXP', 'Este é o formado do e-mail que os usuários irão receber quando eles fazem o download de suas próprias mensagens do arquivo. Mantenha as variáveis %user%, %msgdate% e %msgbody% intactas. ');	
		// translators info: Don't translate %you%, %user%, etc. in the strings above. 
DEFINE ('_UDDEADM_INBOXLIMIT_HEAD', 'Selecione o limite da Caixa de Entrada');
DEFINE ('_UDDEADM_INBOXLIMIT_EXP', 'Você poderá definir o número de mensagens na Caixa de Entrada e no arquivo. Nesse caso o número de mensagens não poderá ultrapassar o valor fixado. Alternativamente, você poderá selecionar o limte da caixa de saída. Nesse caso os usuários não terão conhecimento do número de mensagens exibidas na caixa de saída. Se o limite for atingido o usuário não poderá responder ou compor novas mensagens até que eles apaguem as mensagens antigas tanto na caixa de saída ou no arquivo.');
DEFINE ('_UDDEADM_SHOWINBOXLIMIT_HEAD', 'Exibir limite usado na Caixa de Entrada');
DEFINE ('_UDDEADM_SHOWINBOXLIMIT_EXP', 'Exibir quantas mensagens os usuários estão armazenando (e quanto é permitido armazenar) na linha abaixo da Caixa de Entrada.');
DEFINE ('_UDDEADM_ARCHIVETOTRASH_INTRO', 'Você esta saindo do Arquivo. Como deseja controlar as mensagens que são salvas no arquivo?');
DEFINE ('_UDDEADM_ARCHIVETOTRASH_LEAVE_LINK', 'Deixe-as');		
DEFINE ('_UDDEADM_ARCHIVETOTRASH_LEAVE_EXP', 'Deixe-as no Arquivo (o usuário não será capaz de acessá-las e elas continuarão contando para fins de limites de mensagens).');		
DEFINE ('_UDDEADM_ARCHIVETOTRASH_INBOX_LINK', 'Mover para Caixa de Entrada');
DEFINE ('_UDDEADM_ARCHIVETOTRASH_INBOX_DONE', 'Mensagem Arquivada movida para lixeira');
DEFINE ('_UDDEADM_ARCHIVETOTRASH_INBOX_EXP', 'A mensagem foi movida para a caixa de entrada do usuário (or to trash if they are older than allowed in the inbox).');

		
// 0.4 frontend, but visible admins only (no translation necessary)		

DEFINE ('_UDDEIM_SEND_ASSYSM', 'enviar mensagem de sistema (=destinatário não pode responder)');
DEFINE ('_UDDEIM_SEND_TOALL', 'enviar para todos os usuários');
DEFINE ('_UDDEIM_SEND_TOALLADMINS', 'enviar para todos os admins');
DEFINE ('_UDDEIM_SEND_TOALLLOGGED', 'enviar para todos os usuários on-line');
DEFINE ('_UDDEIM_VALIDFOR_1', 'válido para ');
DEFINE ('_UDDEIM_VALIDFOR_2', ' horas. 0=para sempre (exclusão automática)');
DEFINE ('_UDDEIM_WRITE_SYSM_GM', '[Criar uma mensagem de sistema ou geral]');
DEFINE ('_UDDEIM_WRITE_NORMAL', '[Criar uma mensagem normal (padrão)]');
DEFINE ('_UDDEIM_NOTALLOWED_SYSM_GM', 'Mensagens de sistema e geral não permitidas.');
DEFINE ('_UDDEIM_SYSGM_TYPE', 'Tipo de mensagem');
DEFINE ('_UDDEIM_HELPON_SYSGM', 'Ajuda em mensagem de sistema');
DEFINE ('_UDDEIM_HELPON_SYSGM_2', '(abrir em uma nova janela)');

DEFINE ('_UDDEIM_SYSGM_PLEASECONFIRM', 'Você está a ponto de enviar a mensagem exibida abaixo. Por favor faça uma revisão e confirme ou cancele!');
DEFINE ('_UDDEIM_SYSGM_WILLSENDTOALL', 'Mensagem para <strong>todos os usuários</strong>');
DEFINE ('_UDDEIM_SYSGM_WILLSENDTOALLADMINS', 'Mensagem para<strong>todos os administradores</strong>');
DEFINE ('_UDDEIM_SYSGM_WILLSENDTOALLLOGGED', 'Mensagem para  <strong>todos que estão atualmente logados como usuários</strong>');
DEFINE ('_UDDEIM_SYSGM_WILLDISABLEREPLY', 'Os destinatários não poderão responder a esta mensagem.');
DEFINE ('_UDDEIM_SYSGM_WILLSENDAS_1', 'Mensagem será enviada com <strong>');
DEFINE ('_UDDEIM_SYSGM_WILLSENDAS_2', '</strong> como nome de usuário');

DEFINE ('_UDDEIM_SYSGM_WILLEXPIRE', 'Mensagem irá expirar ');
DEFINE ('_UDDEIM_SYSGM_WILLNOTEXPIRE', 'Mensagem não expira');
DEFINE ('_UDDEIM_SYSGM_CHECKLINK', '<b>Confira o link (clicando nele) antes de prosseguir!</b>');
DEFINE ('_UDDEIM_SYSGM_SHORTHELP', 'Usar <strong>em mensagens de sistema somente</strong>:<br /> [b]<strong>negrito</strong>[/b] [i]<em>itálico</em>[/i]<br />
[url=http://www.algumsite.com]texto com link url[/url] ou [url]http://www.algumsite.com[/url] são links');
DEFINE ('_UDDEIM_SYSGM_ERRORNORECIPS', 'Erro: Nenhum destinatário encontrado. Mensagem não enviada.');
		
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

DEFINE ('_UDDEADM_TEMPLATEDIR_HEAD', 'Tema do uddeIM');
DEFINE ('_UDDEADM_TEMPLATEDIR_EXP', 'Escolha qual tema você deseja que o uddeIM use');
DEFINE ('_UDDEADM_SHOWCONNEX_HEAD', 'Mostrar Conexões CB');
DEFINE ('_UDDEADM_SHOWCONNEX_EXP', 'Use <i>sim</i> se você tem o Community Builder instalado e quer apresentar ao usuário os nomes das conexões dele durante a composição de uma nova mensagem.');
DEFINE ('_UDDEADM_SHOWSETTINGSLINK_HEAD', 'Mostrar configurações');
DEFINE ('_UDDEADM_SHOWSETTINGSLINK_EXP', 'O link de configurações aparece no uddeIM se você ativar a notificação por e-mail ou o sistema de bloqueio. Se você não quer isso, você pode deixar aqui desligado. ');
DEFINE ('_UDDEADM_SHOWSETTINGS_ATBOTTOM', 'sim, no final');
DEFINE ('_UDDEADM_ALLOWBB_HEAD', 'Permitir BB codes');
DEFINE ('_UDDEADM_FONTFORMATONLY', 'Apenas Formatação de Fonte');
DEFINE ('_UDDEADM_ALLOWBB_EXP', 'Use <i>apenas formatação de fonte</i> para permitir que os usuários usem os bb codes para negrito, itálico, subescrito, cor da fonte e tamanho da fonte. Quando você deixa esta opção com <i>sim</i>, os usuários podem usar <strong>todos</strong> os BB codes suportados nas mensagens deles (inclusive para inserção de links e imagens).');
DEFINE ('_UDDEADM_ALLOWSMILE_HEAD', 'Permitir Emoticons');
DEFINE ('_UDDEADM_ALLOWSMILE_EXP', 'Se definir <i>sim</i>, códigos de atalho de emoticon como :-) são substituídos com a imagem do emoticon na exibição da mensagem. Veja o arquivo README para uma lista com os emoticons suportados.');
DEFINE ('_UDDEADM_DISPLAY', 'Exibição');
DEFINE ('_UDDEADM_SHOWMENUICONS_HEAD', 'Mostrar Ícones de Menu');
DEFINE ('_UDDEADM_SHOWMENUICONS_EXP', 'Se definir <i>sim</i>, os links de menu e de ação serão exibidos com um ícone.');
DEFINE ('_UDDEADM_SHOWTITLE_HEAD', 'Título do Componente');
DEFINE ('_UDDEADM_SHOWTITLE_EXP', 'Informe o cabeçalho para o componente de mensagem privada, por exemplo "Mensagens Privadas". Deixe vazio se você não deseja mostrar um cabeçalho.');
DEFINE ('_UDDEADM_SHOWABOUT_HEAD', 'Mostrar link Sobre');
DEFINE ('_UDDEADM_SHOWABOUT_EXP', 'Se definir <i>sim</i> aparece um link de créditos e licença de software do uddeIM. Este link aparecerá no final da saída HTML do uddeIM.');
DEFINE ('_UDDEADM_STOPALLEMAIL_HEAD', 'Interromper e-mail agora');
DEFINE ('_UDDEADM_STOPALLEMAIL_EXP', 'Marque esta caixa para evitar que o uddeIM envie e-mails (notificações e lembretes) independente das configurações do usuário, quando por exemplo, estiver testando o site. Se você não quer que estes recursos funcionem nunca, defina todas as opções acima com <i>não</i>.');
DEFINE ('_UDDEADM_ADMINIGNITIONONLY_MANUALLY', 'manualmente');
DEFINE ('_UDDEADM_GETPICLINK_HEAD', 'Minitaura do CB em listas');
DEFINE ('_UDDEADM_GETPICLINK_EXP', 'Defina com <i>sim</i> se você quer mostrar as miniaturas do Community Builder dos usuários, nas exibições de listas de mensagens (Caixa de Entrada, Caixa de Saída, etc.)');

// new in 0.5 FRONTEND

DEFINE ('_UDDEIM_SHOWUSERS', 'Mostrar usuários');
DEFINE ('_UDDEIM_CONNECTIONS', 'Conexões');
DEFINE ('_UDDEIM_SETTINGS', 'Configurações');
DEFINE ('_UDDEIM_NOSETTINGS', 'Não há configurações para ajustar.');
DEFINE ('_UDDEIM_ABOUT', 'Sobre'); // as in "About uddeIM"
DEFINE ('_UDDEIM_COMPOSE', 'Nova mensagem'); // as in "write new message", but only one word
DEFINE ('_UDDEIM_EMN', 'E-mail de notificação');
DEFINE ('_UDDEIM_EMN_EXP', 'Você pode receber um e-mail quando recebe mensagens privadas.');
DEFINE ('_UDDEIM_EMN_ALWAYS', 'E-mail de notificação para novas mensagenes');
DEFINE ('_UDDEIM_EMN_NONE', 'Sem e-mail de notificação');
DEFINE ('_UDDEIM_EMN_WHENOFFLINE', 'E-mail de notificação quando offline (desconectado do site)');
DEFINE ('_UDDEIM_EMN_NOTONREPLY', 'Não envie notificação em respostas');
DEFINE ('_UDDEIM_BLOCKSYSTEM', 'Bloqueio de usuário'); // Headline for blocking system in settings
DEFINE ('_UDDEIM_BLOCKSYSTEM_EXP', 'Você pode evitar que usuários lhe enviem mensagens, bloqueando-os. Escolha <i>bloquear usuário</i> quando você vê uma mensagem daquele usuário.'); // block user is the same as _UDDEIM_BLOCKNOW
DEFINE ('_UDDEIM_SAVECHANGE', 'Salvar alterações');
DEFINE ('_UDDEIM_TOOLTIP_BOLD', 'BB Code para texto em negrito. Exemplo: [b]negrito[/b]');
DEFINE ('_UDDEIM_TOOLTIP_ITALIC', 'BB Code para texto em itálico. Exemplo: [i]itálico[/i]');
DEFINE ('_UDDEIM_TOOLTIP_UNDERLINE', 'BB Code para texto sublinhado. Exemplo: [u]sublinhado[/u]');
DEFINE ('_UDDEIM_TOOLTIP_COLORRED', 'BB Code para cor vermelha. Exemplo [color=#ff4040]vermelho[/color] onde o #ff4040 é o código hexadecimal da cor vermelha.');
DEFINE ('_UDDEIM_TOOLTIP_COLORGREEN', 'BB Code para cor verde. Exemplo [color=#40ff40]verde[/color] onde o #40ff40 é o código hexadecimal da cor verde.');
DEFINE ('_UDDEIM_TOOLTIP_COLORBLUE', 'BB Code para cor azul. Exemplo [color=#4040ff]azul[/color] onde o #4040ff é o código hexadecimal da cor azul.');
DEFINE ('_UDDEIM_TOOLTIP_FONTSIZE1', 'BB Code para letras muito pequenas. Exemplo: [size=1]letras muito pequenas.[/size]');
DEFINE ('_UDDEIM_TOOLTIP_FONTSIZE2', 'BB Code para letras pequenas. Exemplo: [size=2]letras pequenas.[/size]');
DEFINE ('_UDDEIM_TOOLTIP_FONTSIZE4', 'BB Code para letras grandes. Exemplo: [size=4]letras grandes.[/size]');
DEFINE ('_UDDEIM_TOOLTIP_FONTSIZE5', 'BB Code para letras muito grandes. Exemplo: [size=5]letras muito grandes.[/size]');
DEFINE ('_UDDEIM_TOOLTIP_IMAGE', 'BB Code para inserir uma imagem. Exemplo: [img]link_da_imagem[/img]');
DEFINE ('_UDDEIM_TOOLTIP_URL', 'BB Code para inserir um link. Exemplo: [url]www.algumsite.com[/url]. Procure sempre informar o http:// no link.');
DEFINE ('_UDDEIM_TOOLTIP_CLOSEALLTAGS', 'Fechar as tags de BB code abertas.');
DEFINE ('_UDDEIM_INBOX_LIMIT_2_SINGULAR', ' mensagem na sua'); // same as _UDDEIM_INBOX_LIMIT_2, but singular (as in 1 "message in your")
DEFINE ('_UDDEIM_ARC_SAVED_NONE_2', '<strong>Você não tem mensagens em seu arquivo.</strong>'); 
