/*
    function setChangeState(e){
        var input_state = document.getElementById('state');
        input_state.value = e.target.dataset.state;
        document.getElementById('change-state-form').submit();
    }
*/
      
    window.onload = function(){
       
        var submitEnabled = false;
        function selectInput(e){
            var element = e.target;
            var id = element.dataset.brother;
            input = document.getElementById(id);
            input.removeAttribute('readonly');
            input.focus();
            old_input_value = input.value;
        }
        function activateSubmit(e){
            var input_modified = old_input_value == input.value;
            if(!submitEnabled && !input_modified){
                var button = document.getElementById('button-submit');
                button.removeAttribute('disabled');
            }
        }
        var elems_dropdowns = document.querySelectorAll('.dropdown-trigger');
        var instances_dropdowns = M.Dropdown.init(elems_dropdowns);

        var elems_select = document.querySelectorAll('select');
        var instances = M.FormSelect.init(elems_select);

        var edit = document.querySelectorAll('.edit');
        var max = edit.length;
        for(var i = 0; i<max; i++){

            edit[i].onclick = selectInput;
        }

/*
        var changeState = document.querySelectorAll('.changeState');
        var max_change = changeState.length;

        for(var i = 0; i<max_change; i++){

            changeState[i].onclick = setChangeState;
        }
*/

        var inputs = document.querySelectorAll('.input-editable');
        var max = inputs.length;
        for(var i = 0; i<max; i++){
            inputs[i].onkeyup = activateSubmit;
        }


        var checks = document.querySelectorAll('.check-editable');
        var max = checks.length;
        for(var i = 0; i<max; i++){

            checks[i].onchange = activateSubmit;
        }
    }