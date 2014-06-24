<?php

class Constants
{
	public static $attack_methods = array(
		'0' => 'Brute Force',
		'1' => 'Mask',
		'2' => 'Dictionary'
	);

	public static $attack_types = array(
		'0' => 'HashCat',
		'1' => 'Rainbow Table'
	);

	public static $status = array(
		'P' => 'Pending',
		'F' => 'Failed',
		'S' => 'Success',
		'T' => 'Partial',
		'R' => 'Running'
	);
	public static $hash_cat_types = array(
		'0' => 'MD5',
		'10' => 'md5($pass.$salt)',
		'20' => 'md5($salt.$pass)',
		'30' => 'md5(unicode($pass).$salt)',
		'40' => 'md5($salt.unicode($pass))',
		'50' => 'HMAC-MD5 (key = $pass)',
		'60' => 'HMAC-MD5 (key = $salt)',
		'100' => 'SHA1',
		'110' => 'sha1($pass.$salt)',
		'120' => 'sha1($salt.$pass)',
		'130' => 'sha1(unicode($pass).$salt)',
		'140' => 'sha1($salt.unicode($pass))',
		'150' => 'HMAC-SHA1 (key = $pass)',
		'160' => 'HMAC-SHA1 (key = $salt)',
		'190' => 'sha1(LinkedIn)',
		'200' => 'MySQL323',
		'300' => 'MySQL4.1/MySQL5',
		'400' => 'phpass, MD5(Wordpress), MD5(phpBB3), MD5(Joomla)',
		'500' => 'md5crypt, MD5(Unix), FreeBSD MD5, Cisco-IOS MD5',
		'900' => 'MD4',
		'1000' => 'NTLM',
		'1100' => 'Domain Cached Credentials, mscash',
		'1400' => 'SHA256',
		'1410' => 'sha256($pass.$salt)',
		'1420' => 'sha256($salt.$pass)',
		'1430' => 'sha256(unicode($pass).$salt)',
		'1440' => 'sha256($salt.unicode($pass))',
		'1450' => 'HMAC-SHA256 (key = $pass)',
		'1460' => 'HMAC-SHA256 (key = $salt)',
		'1500' => 'descrypt, DES(Unix), Traditional DES',
		'1600' => 'md5apr1, MD5(APR), Apache MD5',
		'1700' => 'SHA512',
		'1710' => 'sha512($pass.$salt)',
		'1720' => 'sha512($salt.$pass)',
		'1730' => 'sha512(unicode($pass).$salt)',
		'1740' => 'sha512($salt.unicode($pass))',
		'1750' => 'HMAC-SHA512 (key = $pass)',
		'1760' => 'HMAC-SHA512 (key = $salt)',
		'1800' => 'sha512crypt, SHA512(Unix)',
		'2100' => 'Domain Cached Credentials2, mscash2',
		'2400' => 'Cisco-PIX MD5',
		'2410' => 'Cisco-ASA MD5',
		'2500' => 'WPA/WPA2',
		'2600' => 'Double MD5',
		'3000' => 'LM',
		'3100' => 'Oracle 7-10g, DES(Oracle)',
		'3200' => 'bcrypt, Blowfish(OpenBSD)',
		'4400' => 'md5(sha1($pass))',
		'4500' => 'Double SHA1',
		'4700' => 'sha1(md5($pass))',
		'4800' => 'MD5(Chap), iSCSI CHAP authentication',
		'5000' => 'SHA-3(Keccak)',
		'5100' => 'Half MD5',
		'5200' => 'Password Safe SHA-256',
		'5300' => 'IKE-PSK MD5',
		'5400' => 'IKE-PSK SHA1',
		'5500' => 'NetNTLMv1-VANILLA / NetNTLMv1+ESS',
		'5600' => 'NetNTLMv2',
		'5700' => 'Cisco-IOS SHA256',
		'5800' => 'Samsung Android Password/PIN',
		'6000' => 'RipeMD160',
		'6100' => 'Whirlpool',
		'6200' => 'TrueCrypt 5.0+ (see below)',
		'6300' => 'AIX {smd5}',
		'6400' => 'AIX {ssha256}',
		'6500' => 'AIX {ssha512}',
		'6600' => '1Password, agilekeychain',
		'6700' => 'AIX {ssha1}',
		'6800' => 'Lastpass',
		'6900' => 'GOST R 34.11-94',
		'7100' => 'OSX v10.8 / v10.9',
		'7200' => 'GRUB 2',
		'7300' => 'IPMI2 RAKP HMAC-SHA1',
		'7400' => 'sha256crypt, SHA256(Unix)',
		'7500' => 'Kerberos 5 AS-REQ Pre-Auth etype 23',
		'7700' => 'SAP CODVN B (BCODE)',
		'7800' => 'SAP CODVN F/G (PASSCODE)',
		'7900' => 'Drupal7',
		'8000' => 'Sybase ASE',
		'8100' => 'Citrix Netscaler',
		'8200' => '1Password, cloudkeychain',
		'8300' => 'DNSSEC (NSEC3)',
		'8400' => 'WBB3, Woltlab Burning Board 3'
	);

	public static $dictionaries = array(
		'RockYou',
		'Top 10K'
	);
}