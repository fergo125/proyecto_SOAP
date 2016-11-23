<?php

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


/**
 * HolaMundo Clase que implementa el típico primer ejemplo de programación en todo lenguaje.
 *
 * @package SoapDiscovery
 * @author Braulio José Solano Rojas
 * @copyright Copyright (c) 2005-2015 Braulio José Solano Rojas
 * @version $Id$
 * @access public
 **/
class Gato {
	private $jugador1 = '';
	private $jugador2 = '';
  private $board;

	/**
	 * HolaMundo::__construct() Constructor de la clase HolaMundo.
	 *
	 * @param string $nombre
	 * @return string
	 **/
	public function __construct() {
	}

	/**
	 * HolaMundo::salude() Saluda al Mundo o a $this->nombre o saluda a $nombre si $nombre no es vacío.
	 *
	 * @param string $nombre1
   * @param string $nombre2
	 * @return string
	 **/
	public function newGame($nombre1,$nombre2= '') {
		$this->jugador1=$nombre1;
    $this->jugador1=$nombre1;
    $this->gato = array(array('','',''),array('','',''),array('','',''));
    return 'START';
	}

	/**
	 * HolaMundo::servidorEstampillaDeTiempo() Devuelve el tiempo del servidor.
	 *
	 * @return string
	 **/
	public function makeMove($x,$y,$player) {
		if($this->gato[$x][$y] == ''){
      $this->gato[$x][$y] = $player;
      //check if won
      return 'COOL';
    }
    return 'NOT_COOL';
	}
}

?>
