<?php

function cekSession()
{
	$ci = get_instance();
	if(!$ci->session->userdata('username')) {
		redirect('admin');
	}
}

function cekMenu()
{
	$ci = get_instance();
	if($ci->session->userdata('level') == 'user') {
		redirect('user/dashboard');
	}
}
