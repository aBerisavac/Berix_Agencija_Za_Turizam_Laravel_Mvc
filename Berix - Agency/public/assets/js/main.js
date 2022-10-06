$(document).ready(function(){

    $(".carousel").carousel({
        'pause': false
    });


    //Navigation Menu Functionalities
    //region
        function getUrlPath(){
            let urlPath =  window.location.pathname.split("/");
            urlPath = urlPath[urlPath.length - 1];
            return urlPath;
        }

        $("#scroll-to-top").click(()=>window.scrollTo(0,0));
        $(document).scroll(function(){
            if($("header")[0].offsetTop>300){
                $("#scroll-to-top").css('display', 'flex');
            } else{
                $("#scroll-to-top").css('display', 'none');
            }
        });

        function setActiveNavMenuItem(currentNavMenuItem){

            let arrayOfNavMenuItems = $("nav a");
            let i=0;

            for (navMenuItem of arrayOfNavMenuItems){

                let navMenuItemPath = navMenuItem.href.split("/");
                navMenuItemPath = navMenuItemPath[navMenuItemPath.length - 1];

                if(currentNavMenuItem==navMenuItemPath){
                    arrayOfNavMenuItems[i].classList.add('active-nav-item');
                    break;
                }

                i++;
            }
        }

        setActiveNavMenuItem(getUrlPath());
    //endregion
    //End Navigation Menu Functionalities

    //Responsive
    //region
        function showNavMenuItemsViaButtonClick(){
            $("nav ul").toggleClass("show");
        }
        $("#btnMenu").click(()=>showNavMenuItemsViaButtonClick());
    //endregion
    //End Responsive

    //Popup functionalities
    //region
        function showPopUp(id) {

            let screenWidth = $(window).width();
            let screenHeight = $(window).height();

            $("#" + id).css({
                'width': screenWidth + 'px',
                'height': screenHeight + 'px',
                'display': 'flex'
            });
            $("#" + id).children().addClass('visible');
            $("#" + id).children().removeClass('invisible');
        }
        function dropPopUp() {
            $(".popup-whole-screen").css("display", "none");
            $(".popup-whole-screen").children().removeClass('visible');
            $(".popup-whole-screen").children().addClass('invisible');
        }

        $(window).resize(function () {
            screenWidth = $(window).width();
            screenHeight = $(window).height();

            if ($("#login-form").css('display') == "flex") {
                dropPopUp();
                showPopUp("login-form");
            }

            if ($("#register-form").css('display') == "flex") {
                dropPopUp();
                showPopUp("register-form");
            }

            if ($("#contact-form").css('display') == "flex") {
                dropPopUp();
                showPopUp("contact-form");
            }

        });

        $(document).keyup(function(e){

            if(e.keyCode === 27)
                dropPopUp();

        });
        //Show popups
        $("nav ul li:contains('Login')").click(function(){
            showPopUp('login-form');
        })
        $("nav ul li:contains('Contact')").click(function(){
            showPopUp('contact-form');
        })

        $("#login-form .register").click(function(){
            dropPopUp();
            showPopUp('register-form');
        })
        $("#login-form .return").click(()=>dropPopUp());
        $("#contact-form .return").click(()=>dropPopUp());
        $("#register-form .return").click(function(){
            dropPopUp();
            showPopUp('login-form');
        });

        //initial presentation
        $("#register-password").attr('type', 'password');
        $("#login-password").attr('type', 'password');
        $("#contact-message").attr('type', 'textarea');

        if($("#register-span").text().trim()!="") showPopUp("register-form");
        if($("#login-span").text().trim()!="") showPopUp("login-form");
        if($("#contact-span").text().trim()!="") showPopUp("contact-form");
    //endregion
    //End Popup Functionalities

    //Register Functionalities
    //region
        //Checking Fields

            //Regular Expressions

                let reFirstName = /^[a-z ,.'-]{2,30}$/;
                let reLastName = /^[a-z ,.'-]{2,30}$/;
                let rePassword = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%#*?&]{8,}$/;
                let rePhoneNumber = /(^\+[\d]{10,13})|(^\+[\d]{3,5}(\s\d{2,4}){1,4})/;
                let reEmail = /(?:[a-z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+\/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9]))\.){3}(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9])|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/;
                let reMessage = /^[\w .,!?:;]{2,200}$/
            //End Regular Expressions

            //If input is correct remove span text.
            $("#register-form .form-input-element input").blur(function(){
                checkAllRegistrationFields()
            });

            //Self explanatory
            function checkAllRegistrationFields() {
                let firstName = $("#register-first-name").val().toLowerCase();
                let lastName = $("#register-last-name").val().toLowerCase();
                let password = $("#register-password").val();
                let phoneNumber = $("#register-phone-number").val();
                let email = $("#register-email").val().toLowerCase();
                let alltrue=0

                alltrue+=  checkRegularExpression(reFirstName, firstName, "Name must be between 2 and 30 characters long.", 'register-first-name-span');
                alltrue+=  checkRegularExpression(reLastName, lastName, "Last name must be between 2 and 30 characters long.", 'register-last-name-span');
                alltrue+=  checkRegularExpression(rePassword, password, "Must be at least 8 characters long, with at least 1 number, 1 upper, 1 lower letter and 1 special character.", 'register-password-span');
                alltrue+=  checkRegularExpression(rePhoneNumber, phoneNumber, "Number must be in +<country code> format.", 'register-phone-number-span');
                alltrue+=  checkRegularExpression(reEmail, email, "Email format is not valid.", 'register-email-span');

                return alltrue==5;
            }

            function checkRegularExpression(regEx, ex, errMessage, spanId){
                if(!regEx.test(ex)&&ex!="") {
                    $("#"+spanId).text(errMessage);
                    $("#"+spanId).css('padding', '5px');
                    return 0;
                } else if(ex==""){
                    $("#"+spanId).text("");
                    $("#"+spanId).css('padding', '0px');
                    return 0;
                }
                else {
                    $("#"+spanId).text("");
                    $("#"+spanId).css('padding', '0px');
                    return 1;
                };
            }

            function checkOptionalRegularExpression(regEx, ex, errMessage, spanId){
                if(!regEx.test(ex)&&ex!="") {
                    $("#"+spanId).text(errMessage);
                    $("#"+spanId).css('padding', '5px');
                    return 0;
                } else if(ex==""){
                    $("#"+spanId).text("");
                    $("#"+spanId).css('padding', '0px');
                    return 1;
                }
                else {
                    $("#"+spanId).text("");
                    $("#"+spanId).css('padding', '0px');
                    return 1;
                };
            }

        //End Checking Fields

        //Submit form
        $("#register-form .register").click(function(){
            if(checkAllRegistrationFields()){
                $("#registration-form").submit();
            } else{
                $("#register-span").text("All information must be entered correctly!");
                $("#register-span").css('padding', '5px');
            }
        })
    //endregion
    //End Register Functionalities

    //Login Functionalities
    //region
    //If input is correct remove span text.
    $("#login-form .form-input-element input").blur(function(){
        checkAllLoginFields()
    });
    function checkAllLoginFields(){
        let email = $("#login-email").val().toLowerCase();
        let password = $("#login-password").val();
        let alltrue=0

        alltrue+=  checkRegularExpression(rePassword, password, "Must be at least 8 characters long, with at least 1 number, 1 upper, 1 lower letter and 1 special character.", 'login-password-span');
        alltrue+=  checkRegularExpression(reEmail, email, "Email format is not valid.", 'login-email-span');

        return alltrue==2;
    }

    //Submit form

    $("#login-form #login").click(function(){
        if(checkAllLoginFields()){
            $("#login-span").text("Please wait...");
            $("#login-span").css('padding', '5px');
            setTimeout(()=>$("[name='login-form']").submit(), 1000);
        } else{
            $("#login-span").text("All information must be entered correctly!");
            $("#login-span").css('padding', '5px');
        }
    })
    //endregion
    //End Login Functionalities


    //Contact Popup
    //region
    //If input is correct remove span text.
        $("#contact-form .form-input-element input").blur(function(){
            checkAllContactFields();
        });

        //Self explanatory
        function checkAllContactFields() {
            let message = $("#contact-message").val();
            let email = $("#contact-email").val();
            let alltrue=0

            alltrue+=  checkRegularExpression(reMessage, message, "Message is either too long or you used characters which are not allowed.", 'contact-message-span');
            alltrue+=  checkOptionalRegularExpression(reEmail, email, "Email format is not valid.", 'contact-email-span');

            return alltrue==2;
        }

        //Submit

        $("#contact-form #contact").click(function(){
            if(checkAllContactFields()){
                $("#contact-span").text("Please wait...");
                $("#contact-span").css('padding', '5px');
                setTimeout(()=>$("[name='contact-form']").submit(), 1000);
            } else{
                $("#contact-span").text("All information must be entered correctly!");
                $("#contact-span").css('padding', '5px');
            }
        })
    //endregion
    //End Contact Popup

    //Show Specific Destination
    //region

    function addShowSpecificDestinationListener(){
        $("#main-index .carousel").click(function(){
            let id = $(this).attr('data-id');
            $.ajax({
                'url': '/show/'+id,
                'method': 'get',
                success: function(response){
                    //console.log("Uspesno: "+response.destination.id);
                    writeSpecificDestination(response.destination);
                },
                error: function(xhr){
                    console.log("Neuspesno");
                }
            });
        });
    }

    function writeSpecificDestination(destination){
            let i=0;
            let html=`<a href="/index"><div id="return-to-index">
        <i class="fa-solid fa-arrow-left-long">&nbsp;&nbsp;Return</i>
    </div></a><div id="specific-destination-holder" >`;

            //ispis naslova
            html+=`<h3> ${destination.name} </h3>`

        //ispis karousela
        html+=`
            <div class="carousel slide" data-bs-ride="carousel" data-id="${destination.id}">
                <div class="carousel-inner">
                `;

            for(let image of destination.information_images){
                html+=`
                    <div class="carousel-item ${i==0?'active':''}">
                        <img src="/assets/images/Destinations/` + destination.name+`/`+image.src+`.jpg" class="d-block w-100" alt="${image.alt}">
                    </div>
                    `;
                i++;
            }
            i=0;
        //gotov ispis carousela

        //ispis informacija o destinaciji
            let allDestinationInformation = destination.information[0].description;
            allDestinationInformation=allDestinationInformation.split('\n');
            html+=`</div></div><div id="destination-information-holder"><hr/>`;
            for(let destinationInformation of allDestinationInformation){
                html+=`<p>${destinationInformation}</p><hr/>`;
            }

            html+=`</div>`;

            //gotov ispis informacija o destinaciji

        //ispis aktivnosti
        html+=`<div id="destination-activities-holder" class="holder"><h4>Activities:</h4><hr/>`;

        for(let activity of destination.activities){
            html+=`<div class="activity-holder"><h5>${activity.name}</h5>`;
            //ispis karousela
            html+=`
            <div class="carousel slide" data-bs-ride="carousel" data-id="${destination.id}">
                <div class="carousel-inner">
                `;

            for(let image of  activity.images){
                html+=`
                    <div class="carousel-item ${i==0?'active':''}">
                        <img src="/assets/images/Activities/` + activity.name+`/`+image.src+`.jpg" class="d-block w-100" alt="${image.alt}">
                    </div>
                    `;
                i++;
            }
            i=0;
            html+=`</div>`;
            html+=`</div>`;
            //gotov ispis karousela

            //ispis informacija o aktivnosti
            html+=`<div class="activity-information"><p>${activity.description}</p>`;

            html+=`<hr/></div>`;
            //gotov ispis informacija o aktivnosti
            html+=`</div>`;
        }
        //gotov ispis aktivnosti

        html+=`</div>`;
            $("#main-index").html(html);

        $(".carousel").carousel({
            'pause': false
        });

        window.scrollTo(0,0);
    }

    addShowSpecificDestinationListener();
        //endregion
    //End Show Specific Destination


    //Admin Panel
    //region

    //SELECT SVIH TABELA
    //region
    function writeTableData(table){
        let text = `<table><thead><tr>`;
        if (table != false) {

            columns = Object.keys(table[0]);
            for ( let column of columns) {
                text += `<th>` + column + `</th>`;
            }

            text += `
            <th>EDIT</th>
            <th>DELETE</th></tr></thead><tbody>
        `;

            for (let row of table) {
                text += "<tr>"

                for (let column of columns) {
                    text += `<td>` + row[column] + `</td>`;
                }

                //ako treba da se za odredjenu tabelu zabrani update
                //text += localStorage.getItem("tableChosenForManipulating") == "User" ? "<td>FORBIDDEN</td>" : `<td><input type="button" data-action="update" data-id="${row.id}" value="EDIT"/></td>`;
                text += localStorage.getItem("tableChosenForManipulating") != "" ? "<td>FORBIDDEN</td>" : `<td><input type="button" data-action="update" data-id="${row.id}" value="EDIT"/></td>`;

                text += `
            <td><input type="button" data-action="delete" data-id="${row.id}" value="DELETE"/></td>
            `;

                text += `</tr>`
            }

            text += `</tbody></table>`;
        } else {
            text = "There are no items left in this table";
        }

        $("#table-information-wrapper").html(text);
        $("#table-information-wrapper").css("display", "inherit");
        addDeleteListener();
    }

    function writeTable(table){
        localStorage.setItem("tableChosenForManipulating", table);

        //ispis za pretragu ako tabela postoji
        if(table=="default") {
            $("#admin-search").css('display', 'none');
            $("#table-information-wrapper").html(`Select a table`);
            return;
        } else{
            $("#admin-search").css('display', 'block');
        }

        $.ajax({
            'url': '/select/'+table,
            'method' : 'get',
            success: function(response){
                //console.log("Uspesno: "+response.table);
                writeTableData(response.table);
                writeSearchSelect(response.table);
            },
            error: function(xhr){
                console.log("Neuspesno"+xhr.responseText);
            }
        });
    }


    $("#select-table-to-show #table-select").change(function(){
       writeTable($(this).val());
    });

    //endregion
    //END SELECT SVIH TABELA

    //PRETRAGA PO KOLONI TABELE
    //region

    function writeSearchSelect(table){
        let text=`<option value="default">Select column to search:</option>`;
        if(localStorage.getItem("tableChosenForManipulating") != "default"){
            let columns = Object.keys(table[0])
            for ( let column of columns) {
                text += `<option value="` + column + `">` + column + `</option>`;
            }
        }

        $("#select-search").html(text);
    }

    function addSearchTermEvent(){
        $("#search-button").click(function(){
           searchTerm($("#select-search")[0].value, $("#search-term").val());
        });
        $("#search-reset").click(function(){
            writeTable($("#select-table-to-show #table-select").val())
        });
    }

    function resetSearch(){
        $("#select-search")[0].value = "default";
        $("#search-term").val("");
    }
    function searchTerm(column, term){
        if (term.trim()==""||column=="default"){
            $("#invalid-search-term").html("Invalid search term!");
            setTimeout(()=>$("#invalid-search-term").html(""),2000);
            return;
        }

        let table = localStorage.getItem("tableChosenForManipulating");
        $.ajax({
            'url': "/select/"+table+"/"+column+"/"+term,
            'method': "get",
            success: function(response){
                writeTableData(response.table);
                resetSearch();

            },
            error: function(xhr){

            }
        })
    }
    addSearchTermEvent();
    //endregion
    //END PRETRAGA PO KOLONI TABELE

    //DELETE IZ TABELE
    //region

    function addDeleteListener(){
        $("input[data-action='delete']").click(function(){
            deleteItem($(this).attr("data-id"));
        })
    }

    function deleteItem(id){
        let table = $("#select-table-to-show #table-select").val();
        let csrf = $("input[type='hidden']").val()

        $.ajax({
            'url': '/delete/'+table+'/'+id,
            'method' : 'delete',
            data : {
                "_token": csrf
            },
            success: function(response){
                writeTable($("#select-table-to-show #table-select").val())
            },
            error: function(xhr){
                console.log("Neuspesno"+ xhr.responseText);
            }
        })
    }

    addDeleteListener()

    //endregion
    //END DELETE IZ TABELE

    //endregion
    //End Admin Panel
});
