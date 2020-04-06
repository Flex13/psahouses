function populate(s1,s2){
	var s1 = document.getElementById(s1);
	var s2 = document.getElementById(s2);
	s2.innerHTML = "";
	if(s1.value == "South Africa"){
		var optionArray = ["|","Eastern Cape","Free State","Gauteng","KwaZulu-Natal","Limpopo","Mpumalanga","Western Cape","Northern Cape","North West"];
	} else if(s1.value == "Swaziland"){
		var optionArray = ["|","Hhohho","Lubombo","Manzini","Shiselweni"];
	} 
	
	for(var option in optionArray){
		var newOption = document.createElement("option");
		newOption.value = pair[0];
		newOption.innerHTML = pair[1];
		s2.options.add(newOption);
	}
}