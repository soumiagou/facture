@extends('layout')
@section('content')
<head>
<link rel="stylesheet"  href="css/welcome.css">
	<script>
		//ajouter ligne
		var numLigne = 2;
		function ajouterLigne() {
			var table = document.getElementById("facture");
			var row = table.insertRow();
			var designationCell = row.insertCell();
			var quantiteCell = row.insertCell();
			var prixCell = row.insertCell();
			var supprCell = row.insertCell();
			

			designationCell.innerHTML = '<input type="text" required name="designation[]'+numLigne+'" id="designation '+numLigne+'">';
			quantiteCell.innerHTML = '<input  type="number" required min="1" name="quantite[]'+numLigne+'" id="quantite '+numLigne+'" >';
			prixCell.innerHTML = '<input type="number" min="0" required name="prix[]'+numLigne+'" id="prix '+numLigne+'">';
			supprCell.innerHTML = '<button onclick="supprimerLigne(this)" name="supprimer" class="supprimer">-</button>';
			document.getElementById('numLigne').value = ++numLigne;
		}	

		//supprimer ligne
		function supprimerLigne(button) {
			var row = button.parentNode.parentNode;
			var table = row.parentNode;
			table.deleteRow(row.rowIndex);
			document.getElementById('numLigne').value = --numLigne;
		}
	</script>
</head>
<body>
	<div class="acceuil">
		<img src='/pictures/logo.png'  id="home" class="logo"><p class="p1">facture</p>
		<div class="div1">
			<a href="#acceuil">Accueil</a>
			<a href="https://www.yool.education/a-propos" target="blank">À propos</a>
			<a href="#contact">Contact</a>
		</div>
	</div>
		<img src="/pictures/login.png" class="login"> 
			<!-- formulaire des données -->
			<form method="POST" action="{{route('facture')}}" >
				@csrf
				<div>
					<div class="remplissez">
						<P>Remplissez les coordonnées de votre facture ici</p>
					</div>
					<div class="f">
						<label>Numéro du Facture :</label><br>
						<input type="text" required name="numero"><br>
					
						<label>Date d'émission :</label><br>
						<input type="date" required name="date1"><br>
					
						<label>Date de délai :</label><br>
						<input type="date" name="date2"><br>
						<table class="radio">
							<tr><label>Mode de reglement :</label></tr>
							<tr>
								<td><input  type="radio" name="mode_reglement" value="Espèces"/>Espèces</td>
								<td><input  type="radio" name="mode_reglement" value="Chèque"/>Chèque</td>
								<td><input  type="radio" name="mode_reglement" value="Virement bancaire"/>Virement bancaire</td>
							</tr>
						</table>
						<label class="client">Les coordonnées du client :</label><br>
		
						<label class="nom">Nom :</label><br>
						<input type="text" name="nom"><br>
					
						<label>Adresse :</label><br>
						<input type="text" name="adresse"><br>
				
						<label>Numéro de Téléphone :</label><br>
						<input type="tel" name="telephone" ><br>
					</div>
				</div>
				
				<!-- la facture -->
				<P class="titre">Facture</P>
				<input type="hidden" name="numLigne" id="numLigne">
				<div class="div">
					<table class="table2" id="facture">
						<tr>
							<th><label >Désignation</label></th>
							<th><label>Quantité</label></th>
							<th><label>Prix </label></th>
						</tr>
						<tr >
							<td><input  type="text"  name="designation[]" required id="designation" /></td>
							<td><input  type="number" name="quantite[]" required id="quantite" min="1" /></td>
							<td><input  type="number" name="prix[]" required id="prix" min="0"/></td>
						</tr>
					</table>
				</div>	
				<input type="submit" name="submit" value="Calculer" class="calculer"/>
			</form>
		<input  type="reset" value="Ajouter" name="ajouter" onclick="ajouterLigne()" class="ajouter"/>
		<div class="cont" id="contact">
			<a href="https://www.instagram.com/yool.education/"  target="blank"><img src="{{ asset('pictures/insta.png') }}"></a>
			<a href="https://www.facebook.com/people/Yooleducation/100087537784029/?mibextid=ZbWKwL" target="blank"><img src="{{ asset('pictures/linkedin.png') }}"></a>
			<a href="https://www.linkedin.com/company/yool-education-livelearning/" target="blank"><img src="{{ asset('pictures/fb.png') }}""></a>
			<p class="copyright">Copyright © 2023 <span class="y">YSCHOOL</span>.</p>
		</div>
@endsection
@section('title',' connexion')

