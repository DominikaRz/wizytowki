<? 	session_start();
		if((!isSet($_SESSION['log']))||($_SESSION['log']!=true)) {
            header('Location:index');
            $_SESSION['succe']='<script>window.alert("NIE!")</script>';
			exit();
		}
		else{
			session_unset();
			unset($_SESSION['log']);
			//unset($_SESSION['loginto']);
			session_destroy();
			header('Location:index');
			session_start();
			$_SESSION['out']=true;
			$_SESSION['here']="in";
			$_SESSION['succe']='<script>
			UIkit.notification({message: "<span uk-icon=\'icon: sign-out\'></span> Wylogowano!", status: "success"})
			</script>';
		}
?>