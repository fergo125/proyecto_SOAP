<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
/**
 *
 * Copyright (c) 2005-2015, Braulio José Solano Rojas
 * All rights reserved.
 *
 * Redistribution && use in source && binary forms, with or without modification, are
 * permitted provided that the following conditions are met:
 *
 * 	Redistributions of source code must retain the above copyright notice, this list of
 * 	conditions && the following disclaimer.
 * 	Redistributions in binary form must reproduce the above copyright notice, this list of
 * 	conditions && the following disclaimer in the documentation &&/or other materials
 * 	provided with the distribution.
 * 	Neither the name of the Solsoft de Costa Rica S.A. nor the names of its contributors may
 * 	be used to endorse or promote products derived from this software without specific
 * 	prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS &&
 * CONTRIBUTORS "AS IS" && ANY EXPRESS OR IMPLIED WARRANTIES,
 * INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
 * MERCHANTABILITY && FITNESS FOR A PARTICULAR PURPOSE ARE
 * DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR
 * CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT
 * NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION)
 * HOWEVER CAUSED && ON ANY THEORY OF LIABILITY, WHETHER IN
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
	public  $game = "";
	private $gato = NULL;
	private $leaderboards;
	/**
	 * HolaMundo::__construct() Constructor de la clase HolaMundo.
	 *
	 * @param string $nombre
	 * @return string
	 **/
	public function __construct() {
	}

	/**
	 *Metodo que iniciliza un nuevo juego
	 *
	 * @param string $player1
   * @param string $player2
	 * @return string
	 **/
	public function newGame($player1,$player2) {
		if(strcmp($player2,"") != 0){
			$this->jugador2=$player2;
		}
		else{
			$this->jugador2="COMPU";
		}
		$this->jugador1=$player1;
    $this->gato = array(array('','',''),array('','',''),array('','',''));
    return "START";
	}

	/**
	 * Metodo que se encarga de llevar a cabo un movimiento en el tablero y devuelve el resultado
	 *
	 * @return string
	 **/
	public function makeMove($x,$y,$player) {
		if(strcmp($player,"") == 0){
			$player = "COMPU";
		}
		$response = '';
		$matriz = "";
		foreach($this->gato as $row){
			$matriz = $matriz."[";
			foreach($row as $e){
					$matriz = $matriz.$e.",";
			}
			$matriz = $matriz."],";
		}
		error_log($matriz);
		error_log($player);
		error_log("x:".$x);
		error_log("y:".$y);
		if($x < 0 && $y < 0){
			$response = $this->makeMachineMove();
		}
		else{
			if(strcmp($this->gato[$x][$y],'') == 0){
      	$this->gato[$x][$y] = $player;
      	$response = 'COOL';
    	}
			else{
				$response = 'NOT_COOL';
			}
		}
		$gato_state =  $this->won($player);
		if(strcmp($gato_state,'WON') == 0){
			$response= $response.":WON";
		}
		else{
			$getAvaibleSpaces = count($this->getAvaibleSpaces());
			if($getAvaibleSpaces == 0){
				$response = $response.":TIE";
			}
			else{
				$response = $response.":NORMAL";
			}
		}
		return $response;
	}
	/**
	*Metodo que se encarga de determinar si un jugador ganó.
	**/

	private function won($player){
		if(
		(strcmp($this->gato[0][0],$player) == 0 && strcmp($this->gato[0][1],$player) == 0 && strcmp($this->gato[0][2],$player) == 0) ||
		(strcmp($this->gato[1][0],$player) == 0 && strcmp($this->gato[1][1],$player) == 0 && strcmp($this->gato[1][2],$player) == 0) ||
		(strcmp($this->gato[2][0],$player) == 0 && strcmp($this->gato[2][1],$player) == 0 && strcmp($this->gato[2][2],$player) == 0) ||
		(strcmp($this->gato[0][0],$player) == 0 && strcmp($this->gato[1][0],$player) == 0 && strcmp($this->gato[2][0],$player) == 0) ||
		(strcmp($this->gato[0][1],$player) == 0 && strcmp($this->gato[1][1],$player) == 0 && strcmp($this->gato[2][1],$player) == 0) ||
		(strcmp($this->gato[0][2],$player) == 0 && strcmp($this->gato[1][2],$player) == 0 && strcmp($this->gato[2][2],$player) == 0) ||
		(strcmp($this->gato[0][0],$player) == 0 && strcmp($this->gato[1][1],$player) == 0 && strcmp($this->gato[2][2],$player) == 0) ||
		(strcmp($this->gato[0][2],$player) == 0 && strcmp($this->gato[1][1],$player) == 0 && strcmp($this->gato[2][0],$player) == 0)
		){
		return "WON";
		}
		else{
			return "NOT_WON";
		}
	}
	/**
	*Metodo que devuelve los espacio disponibles.
	**/
	private function getAvaibleSpaces(){
		$spaces = array();
		for ($i = 0;$i < count($this->gato[0]);++$i) {
			for ($j = 0;$j < count($this->gato[0]);++$j) {
				if(strcmp($this->gato[$i][$j],'') == 0){
					//error_log("Free: ".$i.",".$j);
					array_push($spaces, array($i,$j));
				}
			}
		}
		return $spaces;
	}
	/**
	*Metodo que se encarga de determinar el siguiente movimiento de la maquina.
	**/
	private function makeMachineMove(){
		$spaces = $this->getAvaibleSpaces();
	  $space = $spaces[rand()%count($spaces)];
		$this->gato[$space[0]][$space[1]] = $this->jugador2;
		return $space[0].":".$space[1];
	}
	/**
	*Metodo que agrega un nuevo score a la BD
	**/
	public function newScore($player,$time)
	{
		$newScore = new Scores();
		$newScore->nickname = $player;
		$time_split = explode(":", $time);
		error_log($time);
		$newScore->score = $time;
		$newScore->save();
	}
	/**
	 * Metodo que devuelve los resultados de las diferentes partidas
	 *
	 * @return string
	 **/
	public function leaderboards()
	{
		$table = 'eb23990_scores';
		$where = 'score > 0 ORDER BY score';
		$activeRecords = $GLOBALS['db']->GetActiveRecords($table,$where);
		$result = '';
		$i = 0;
		foreach ($activeRecords as $record) {
			if($i < 10){
				$result = $result.$record->nickname .':'.$record->score.",";
				++$i;
			}
		}
		return $result;
	}

}




?>
