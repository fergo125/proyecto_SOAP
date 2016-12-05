<?php
ini_set("soap.wsdl_cache_enabled", 0);
/**
 *
 * Copyright (c) 2005-2015, Braulio José Solano Rojas
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without modification, are
 * permitted provided that the following conditions are met:
 *
 * 	Redistributions of source code must retain the above copyright notice, this list of
 * 	conditions and the following disclaimer.
 * 	Redistributions in binary form must reproduce the above copyright notice, this list of
 * 	conditions and the following disclaimer in the documentation and/or other materials
 * 	provided with the distribution.
 * 	Neither the name of the Solsoft de Costa Rica S.A. nor the names of its contributors may
 * 	be used to endorse or promote products derived from this software without specific
 * 	prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND
 * CONTRIBUTORS "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES,
 * INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
 * MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 * DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR
 * CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT
 * NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION)
 * HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR
 * OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE,
 * EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 *
 * @version $Id$
 * @copyright 2005-2015
 */
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/vendor/adodb/adodb-php/adodb-active-record.inc.php';
require_once __DIR__ . '/vendor/adodb/adodb-php/adodb-time.inc.php';
require_once 'gato.class.php';
require_once 'scores.class.php';
$db = NewADOConnection('postgres9://eb23990:eb23990@localhost/ci2413');
$dictionary = NewDataDictionary($db);
$dictionary->SetSchema('eb23990');
$db->Execute('SET search_path TO eb23990');
ADOdb_Active_Record::SetDatabaseAdapter($db);
$GLOBALS['db']= $db;


function autoinclude($className) {
	$className = str_replace('\\', '/', $className) . '.php';
	require_once $className;
}
spl_autoload_register('autoinclude');
if (isset($_GET['wsdl'])) {
	header('Content-Type: application/soap+xml; charset=utf-8');
	echo file_get_contents('gato.wsdl');
}
else {
	session_start();

	if (!isset($_SESSION['service'])) {
		$_SESSION['service'] = new Gato();
	}
	$servidorSoap = new SoapServer('http://titanic.ecci.ucr.ac.cr:80/~eb23990/PlayGato/?wsdl', array('cache_wsdl' => WSDL_CACHE_NONE));

	//Para evitar la excepción por defecto de SOAP PHP cuando no existe HTTP_RAW_POST_DATA,
	//se regresa explícitamente el siguiente fallo cuando no hay solicitud (v.b. desde un navegador)
	if(!@$HTTP_RAW_POST_DATA){
		$servidorSoap->fault('SOAP-ENV:Client', 'Invalid Request');
		exit;
	}

	$servidorSoap->setObject(new Zend\Soap\Server\DocumentLiteralWrapper($_SESSION['service']));
	$servidorSoap->setPersistence(SOAP_PERSISTENCE_SESSION);
	$servidorSoap->handle();
}

?>
