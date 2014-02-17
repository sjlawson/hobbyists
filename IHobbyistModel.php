<?php

interface IHobbyistModel {
	function editHobbyist();
	
	function createHobbyist();
	
	function getHobbyist($id);
	
	function getAllHobbyistsPaged($page = 1);
}
