<?php

return array (
  'title' => 'Cloudify',
  'setting' => 
  array (
    'title' => 'Nastavení API',
    'description' => 'Nakonfigurujte nastavení API, jako je blokování domén, přístupová oprávnění a omezení rychlosti.',
    'google_drive' => 
    array (
      'enable' => 'Povolit úložiště Google Drive',
      'client_id' => 'ID klienta',
      'client_id_placeholder' => 'Zadejte své ID klienta Google Drive',
      'client_secret' => 'Tajný klíč klienta',
      'client_secret_placeholder' => 'Zadejte svůj tajný klíč klienta Google Drive',
      'refresh_token' => 'Obnovovací token',
      'refresh_token_placeholder' => 'Zadejte svůj obnovovací token Google Drive',
      'folder_id' => 'ID kořenové složky',
      'folder_id_placeholder' => 'Zadejte ID složky Google Drive (volitelné)',
    ),
    'api_key' => 
    array (
      'title' => 'API klíče',
      'token' => 'Token',
      'type' => 'Typ',
      'type_helper' => 'Ujistěte se, že používáte vhodný API klíč pro zamýšlený účel a nikdy nepoužívejte interní API v implementaci na straně klienta.',
      'special' => 'Udělit speciální oprávnění',
      'special_helper' => 'Výběr této možnosti udělí tomuto API klíči speciální přístup k Cloudify API, obejde všechna zavedená omezení API, jako jsou omezení rychlosti, černé listiny domén a černé listiny IP. To může být užitečné, pokud nechcete, aby byly vaše osobní API klíče omezeny.',
      'abilities' => 'Schopnosti',
      'setting' => 
      array (
        'title' => 'API tokeny',
        'description' => 'Spravovat API klíče.',
        'blacklist_domain_failed_attempts' => 'Zablokovat doménu po kolika neúspěšných pokusech?',
        'blacklist_domain_failed_attempts_placeholder' => 'Počet neúspěšných pokusů pro automatické zablokování domény.',
        'blacklist_domain_failed_attempts_helper' => 'Pokud bude dosaženo zadaného počtu neúspěšných pokusů o aktivaci a stahování aktualizací, doména uživatele bude automaticky zablokována. (Poznámka: Tato funkce bude fungovat pouze v případě, že je správně nastaven Cloudify Cron a je povolena možnost "přidat záznamy pro neúspěšné pokusy o aktivaci a stahování".)',
        'blacklist_ip_failed_attempts' => 'Zablokovat IP po kolika neúspěšných pokusech?',
        'blacklist_ip_failed_attempts_placeholder' => 'Počet neúspěšných pokusů pro automatické zablokování IP.',
        'blacklist_ip_failed_attempts_helper' => 'Pokud bude dosaženo zadaného počtu neúspěšných pokusů o aktivaci a stahování aktualizací, IP adresa uživatele bude automaticky zablokována. (Poznámka: To bude fungovat pouze v případě, že je správně nastaven Cloudify Cron a jsou povoleny záznamy pro neúspěšné pokusy o aktivaci a stahování.)',
        'api_rate_limiting_method' => 'Metoda omezení rychlosti API požadavků',
        'limit_method' => 
        array (
          'ip_address' => 'Omezení na IP adresu',
          'api_token' => 'Omezení na API token',
        ),
        'api_requests_rate_limit_per_hour' => 'Omezení rychlosti API požadavků (za hodinu)',
        'api_requests_rate_limit_per_hour_placeholder' => 'Povolené požadavky za hodinu (ponechte prázdné pro neomezené použití)',
        'api_requests_rate_limit_per_hour_helper' => 'Omezení rychlosti API lze implementovat na základě API klíče nebo IP adresy.',
        'api_blacklisted_domains' => 'API zablokované domény',
        'api_blacklisted_domains_placeholder' => 'Domény k zablokování',
        'api_blacklisted_domains_helper' => 'Pokud jsou zadány, přístup k Cloudify API bude pro tyto domény zablokován.',
        'api_blacklisted_ips' => 'API zablokované IP adresy',
        'api_blacklisted_ips_placeholder' => 'IP adresy k zablokování',
        'api_blacklisted_ips_helper' => 'Pokud jsou poskytnuty, přístup k Cloudify API bude pro tyto IP adresy zablokován.',
      ),
    ),
  ),
  'enums' => 
  array (
    'api_key_type' => 
    array (
      'internal' => 'Interní',
      'external' => 'Externí',
    ),
    'external_ability' => 
    array (
      'list_media_folders' => 'Seznam složek médií',
      'create_media_folder' => 'Vytvořit složku médií',
      'edit_media_folder' => 'Upravit složku médií',
      'view_media_folder' => 'Zobrazit složku médií',
      'trash_media_folder' => 'Přesunout složku médií do koše',
      'delete_media_folder' => 'Smazat složku médií',
      'list_media_files' => 'Seznam souborů médií',
      'create_media_file' => 'Vytvořit soubor médií',
      'edit_media_file' => 'Upravit soubor médií',
      'trash_media_file' => 'Přesunout soubor médií do koše',
      'delete_media_file' => 'Smazat soubor médií',
    ),
  ),
  'widget' => 
  array (
    'total_media_folders' => 'Složky',
    'total_media_files' => 'Soubory',
    'total_media_sizes' => 'Velikosti médií',
  ),
);