
alert('main.js works');

function confirm_delete(){
    let yesOrNo = window.confirm('Are you sure?');
    console.log('asked');
    return yesOrNo ? true : false;
}
