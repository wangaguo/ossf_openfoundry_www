<?php

global $jaxFuncNames;
if (!is_array($jaxFuncNames)) $jaxFuncNames = array();

$jaxFuncNames[] = "jcxLoadUserInfo";
$jaxFuncNames[] = "jcxAddComment";
$jaxFuncNames[] = "jcxUpdateComment";
$jaxFuncNames[] = "jcxUnpublish";
$jaxFuncNames[] = "jcxEdit";
$jaxFuncNames[] = "jcxSave";
$jaxFuncNames[] = "jcxReport";      // Report function
$jaxFuncNames[] = "jcxVote";        // Vote function
$jaxFuncNames[] = "jcxShowSendEmail";
$jaxFuncNames[] = "jcxEditComment";
$jaxFuncNames[] = "jcxTrainFilter";
$jaxFuncNames[] = "jcxTrainFilterTest";
$jaxFuncNames[] = "jcxBanUserName";
$jaxFuncNames[] = "jcxBanUserIP";
$jaxFuncNames[] = "jcxTogglePublish";
$jaxFuncNames[] = "jcxLoadLangFile";
$jaxFuncNames[] = "jcxSaveLanguage";
$jaxFuncNames[] = "jcxTrainTrackbackFilter";
$jaxFuncNames[] = "jcxTrainTrackbackFilterTest";
$jaxFuncNames[] = "jcxToggleTrackbackPublish";
$jaxFuncNames[] = "jcxSaveComment";
$jaxFuncNames[] = "jcxDoPatch";
$jaxFuncNames[] = "jcxShowComment";
$jaxFuncNames[] = "jcxDismissReport";
$jaxFuncNames[] = "jcxMyFav";
$jaxFuncNames[] = "jcxRemoveFav";
$jaxFuncNames[] = "jcxSendEmail";
$jaxFuncNames[] = "jcxUnsubscribe"; 		#Unsubscribe comments
$jaxFuncNames[] = "jcxEnableSubscription";  #Enable subscriptions
$jaxFuncNames[] = "jcxDisableSubscription"; #Disable subscription
$jaxFuncNames[] = "jcxRebuildIndex";        #Rebuild index @ Admin
$jaxFuncNames[] = "jcxPatchArtio";          #Patch ArtioSEF Pagination @ Admin
$jaxFuncNames[] = "jcxRestoreArtio";        #Restore ArtioSEF file @ Admin
$jaxFuncNames[] = 'jcxShowTerms';           // Shows terms and conditions
$jaxFuncNames[] = "jcxShowBookmarkThis";
$jaxFuncNames[] = "jcxShowEmailThis";
$jaxFuncNames[] = "jcxShowFavorites";
$jaxFuncNames[] = "jcxPatchContent";		# patch the com_content/content.php
$jaxFuncNames[] = "jcxRestorePatchedContent";
