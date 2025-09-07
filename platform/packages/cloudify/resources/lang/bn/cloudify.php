<?php

return array (
  'title' => 'ক্লাউডিফাই',
  'setting' => 
  array (
    'title' => 'API সেটিংস',
    'description' => 'ডোমেন ব্ল্যাকলিস্টিং, অ্যাক্সেস অনুমতি এবং রেট সীমার মতো API সেটিংস কনফিগার করুন।',
    'google_drive' => 
    array (
      'enable' => 'Google Drive স্টোরেজ সক্ষম করুন',
      'client_id' => 'ক্লায়েন্ট আইডি',
      'client_id_placeholder' => 'আপনার Google Drive ক্লায়েন্ট আইডি লিখুন',
      'client_secret' => 'ক্লায়েন্ট সিক্রেট',
      'client_secret_placeholder' => 'আপনার Google Drive ক্লায়েন্ট সিক্রেট লিখুন',
      'refresh_token' => 'রিফ্রেশ টোকেন',
      'refresh_token_placeholder' => 'আপনার Google Drive রিফ্রেশ টোকেন লিখুন',
      'folder_id' => 'রুট ফোল্ডার আইডি',
      'folder_id_placeholder' => 'আপনার Google Drive ফোল্ডার আইডি লিখুন (ঐচ্ছিক)',
    ),
    'api_key' => 
    array (
      'title' => 'API কী',
      'token' => 'টোকেন',
      'type' => 'টাইপ',
      'type_helper' => 'নিশ্চিত করুন যে আপনি উদ্দেশ্যমূলক ব্যবহারের জন্য উপযুক্ত API কী ব্যবহার করছেন এবং কখনও ক্লায়েন্ট-সাইড বাস্তবায়নে অভ্যন্তরীণ API ব্যবহার করবেন না।',
      'special' => 'বিশেষ অনুমতি দিন',
      'special_helper' => 'এই বিকল্পটি নির্বাচন করলে এই API কী-কে Cloudify API-তে বিশেষ অ্যাক্সেস দেওয়া হবে, রেট সীমা, ডোমেন ব্ল্যাকলিস্ট এবং IP ব্ল্যাকলিস্টের মতো যেকোনো প্রতিষ্ঠিত API সীমাবদ্ধতা বাইপাস করে। এটি দরকারী হতে পারে যদি আপনি আপনার ব্যক্তিগত API কীগুলি সীমাবদ্ধ করতে না চান।',
      'abilities' => 'ক্ষমতা',
      'setting' => 
      array (
        'title' => 'API টোকেন',
        'description' => 'API কী পরিচালনা করুন।',
        'blacklist_domain_failed_attempts' => 'কত ব্যর্থ প্রচেষ্টার পরে ডোমেন ব্ল্যাকলিস্ট করবেন?',
        'blacklist_domain_failed_attempts_placeholder' => 'স্বয়ংক্রিয় ডোমেন ব্ল্যাকলিস্টিংয়ের জন্য ব্যর্থ প্রচেষ্টার সংখ্যা।',
        'blacklist_domain_failed_attempts_helper' => 'যদি নির্দিষ্ট সংখ্যক ব্যর্থ সক্রিয়করণ এবং আপডেট ডাউনলোড প্রচেষ্টায় পৌঁছানো হয়, তবে ব্যবহারকারীর ডোমেন স্বয়ংক্রিয়ভাবে ব্ল্যাকলিস্ট করা হবে। (দ্রষ্টব্য: এই বৈশিষ্ট্যটি কেবল তখনই কাজ করবে যদি Cloudify Cron সঠিকভাবে সেট আপ করা হয় এবং "ব্যর্থ সক্রিয়করণ এবং ডাউনলোড প্রচেষ্টার জন্য এন্ট্রি যুক্ত করুন" বিকল্পটি সক্ষম করা হয়।)',
        'blacklist_ip_failed_attempts' => 'কত ব্যর্থ প্রচেষ্টার পরে IP ব্ল্যাকলিস্ট করবেন?',
        'blacklist_ip_failed_attempts_placeholder' => 'স্বয়ংক্রিয় IP ব্ল্যাকলিস্টিংয়ের জন্য ব্যর্থ প্রচেষ্টার সংখ্যা।',
        'blacklist_ip_failed_attempts_helper' => 'যদি নির্দিষ্ট সংখ্যক ব্যর্থ সক্রিয়করণ এবং আপডেট ডাউনলোড প্রচেষ্টায় পৌঁছানো হয়, তবে ব্যবহারকারীর IP স্বয়ংক্রিয়ভাবে ব্ল্যাকলিস্ট করা হবে। (দ্রষ্টব্য: এটি কেবল তখনই কাজ করবে যদি Cloudify Cron সঠিকভাবে সেট আপ করা হয় এবং ব্যর্থ সক্রিয়করণ এবং ডাউনলোড প্রচেষ্টার জন্য এন্ট্রি অনুমোদিত হয়।)',
        'api_rate_limiting_method' => 'API রিকোয়েস্ট রেট লিমিটিং পদ্ধতি',
        'limit_method' => 
        array (
          'ip_address' => 'প্রতি IP ঠিকানা সীমা',
          'api_token' => 'প্রতি API টোকেন সীমা',
        ),
        'api_requests_rate_limit_per_hour' => 'API রিকোয়েস্ট রেট সীমা (প্রতি ঘন্টা)',
        'api_requests_rate_limit_per_hour_placeholder' => 'প্রতি ঘন্টায় অনুমোদিত রিকোয়েস্ট (সীমাহীন ব্যবহারের জন্য খালি রাখুন)',
        'api_requests_rate_limit_per_hour_helper' => 'API রেট লিমিটিং প্রতি-API কী বা প্রতি-IP ঠিকানা ভিত্তিতে বাস্তবায়িত করা যেতে পারে।',
        'api_blacklisted_domains' => 'API ব্ল্যাকলিস্টেড ডোমেন',
        'api_blacklisted_domains_placeholder' => 'ব্ল্যাকলিস্ট করা ডোমেন',
        'api_blacklisted_domains_helper' => 'যদি নির্দিষ্ট করা হয়, এই ডোমেনগুলির জন্য Cloudify API-তে অ্যাক্সেস ব্লক করা হবে।',
        'api_blacklisted_ips' => 'API ব্ল্যাকলিস্টেড IP',
        'api_blacklisted_ips_placeholder' => 'ব্ল্যাকলিস্ট করা IP',
        'api_blacklisted_ips_helper' => 'যদি সরবরাহ করা হয়, এই IP ঠিকানাগুলির জন্য Cloudify API-তে অ্যাক্সেস ব্লক করা হবে।',
      ),
    ),
  ),
  'enums' => 
  array (
    'api_key_type' => 
    array (
      'internal' => 'অভ্যন্তরীণ',
      'external' => 'বাহ্যিক',
    ),
    'external_ability' => 
    array (
      'list_media_folders' => 'মিডিয়া ফোল্ডার তালিকা',
      'create_media_folder' => 'মিডিয়া ফোল্ডার তৈরি করুন',
      'edit_media_folder' => 'মিডিয়া ফোল্ডার সম্পাদনা করুন',
      'view_media_folder' => 'মিডিয়া ফোল্ডার দেখুন',
      'trash_media_folder' => 'মিডিয়া ফোল্ডার ট্র্যাশ করুন',
      'delete_media_folder' => 'মিডিয়া ফোল্ডার মুছুন',
      'list_media_files' => 'মিডিয়া ফাইল তালিকা',
      'create_media_file' => 'মিডিয়া ফাইল তৈরি করুন',
      'edit_media_file' => 'মিডিয়া ফাইল সম্পাদনা করুন',
      'trash_media_file' => 'মিডিয়া ফাইল ট্র্যাশ করুন',
      'delete_media_file' => 'মিডিয়া ফাইল মুছুন',
    ),
  ),
  'widget' => 
  array (
    'total_media_folders' => 'ফোল্ডার',
    'total_media_files' => 'ফাইল',
    'total_media_sizes' => 'মিডিয়া সাইজ',
  ),
);