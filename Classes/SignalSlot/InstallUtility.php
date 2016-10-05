<?php
namespace NS\NsProtectSite\SignalSlot;

class InstallUtility{

  function afterExtensionUninstall($extensionKey){
    if($extensionKey == "ns_protect_site"){
      $sql = "TRUNCATE TABLE tx_nsprotectsite_domain_model_settings";
      $GLOBALS['TYPO3_DB']->sql_query($sql);
    }
  }
}

?>
