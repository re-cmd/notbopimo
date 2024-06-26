<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require ("shop.php");
require ("../rest.php");

header("Content-type: application/json");

if (isset($_POST["token"])) {
	if ($bop->checkToken($_POST["token"])) {
		if (isset($_POST["id"]) && isset($_POST["price"])) {
			$localUser = $shop->local_info(["id"]);
			if($bop->isBanned($localUser->id)) { die(); };
			if ($localUser) {
				if (isset($_POST['offsale'])) {
					try {
						$edit = $shop->offsaleSale($_POST['id'],$localUser->id);
						$rest->success();
					} catch (Exception $e) {
						$rest->error($e->getMessage());
					}
					die();
				} else {
					try {
						$edit = $shop->editSale($_POST['id'],$localUser->id, $_POST['price']);
						$rest->success();
					} catch (Exception $e) {
						$rest->error($e->getMessage());
					}
					die();
				}
			}
		}
	}
}
echo json_encode(["status" => "error", "error" => "Invalid or missing CSRF token"]);
