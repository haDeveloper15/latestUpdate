//--------- SET || MAIN || VARIABLES || START ------------------>
let fa_bars                       = document.querySelector('.fa-bars');
let main                          = document.querySelector('main');
let fa_cog                        = document.querySelector('.fa-cog');
let cogs_bar                      = document.querySelector('.cogs_bar');
let cogs_bar_close                = document.querySelector('.cogs_bar_close');
let table_main_row                = document.querySelectorAll('.table .main_row');
let search_inp_2                  = document.querySelector('.search_inp_2')
let search_inp_2_input            = document.querySelectorAll('.search_inp_2 input');
let get_data_form                 = document.querySelectorAll('.get_data_form');
let form_close                    = document.querySelectorAll('.form_close');
let fa_pencil_square_o            = document.querySelectorAll('.fa-pencil-square-o');
let del_names                     = document.querySelectorAll('.del_names');
let show_result                   = document.querySelector('.show_result');


//--------- SET || MAIN || VARIABLES || END------------------>

//--------- SET || MAIN || EVENT || START ------------------>
fa_bars.addEventListener('click',() => {
    main.classList.toggle('active_main');
    cogs_bar.classList.remove('active_cog_bar');
})
fa_cog.addEventListener('click',() => {
  cogs_bar.classList.add('active_cog_bar');
  main.classList.remove('active_main');
})
cogs_bar_close.addEventListener('click',() => {
    cogs_bar.classList.remove('active_cog_bar');
})
fa_pencil_square_o.forEach((s,index) => s.addEventListener('click' ,(e) => {
    e.preventDefault();
    get_data_form[index].classList.add('active_form');
}))
form_close.forEach(s => s.addEventListener('click',() => {
  get_data_form.forEach(s => s.classList.remove('active_form'));
}))
//--------- SET || MAIN || EVENT || END------------------>

//-------------Active || Color || Ui || Start --------------------->
table_main_row.forEach((item,index) => {
  if(index % 2 == 0)
  {
      item.classList.add('active_color');
  }
})
//-------------Active || Color || Ui || End --------------------->
