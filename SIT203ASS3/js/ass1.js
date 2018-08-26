    var arr=new Array();//array stores product information
    var display_order='increase';
    var brand_arr=new Array();//array stores selected brands
    var pagesize=6;

function getxml()//get xml file
{
    try //Internet Explorer
    {
        xmlDoc=new ActiveXObject("Microsoft.XMLDOM");
        xmlDoc.async=false;
        xmlDoc.load('product_details.xml');
    }
    catch(e)
    {
        try //Firefox, Mozilla, Opera, etc.
        {
            xmlDoc=document.implementation.createDocument("","",null);
            xmlDoc.async=false;
            xmlDoc.load('product_details.xml');
        }
        catch(e)
        {
            try //Google Chrome
            {
               var xmlhttp = new window.XMLHttpRequest();
               xmlhttp.open("GET",'product_details.xml',false);
               xmlhttp.send(null);
               xmlDoc = xmlhttp.responseXML.documentElement;
            }
            catch(e)
            {
                error=e.message;
            }
        }
    }
    return xmlDoc;
}

function min(a,b)
{
    if(a>b)
        return b;
    else
        return a;
}

function swap(a,b)//swap 2 objects(a and b)
{
    temp=new Object;
    temp.gender=a.gender;
    temp.type=a.type;
    temp.small=a.small;
    temp.large=a.large;
    temp.brand=a.brand;
    temp.price=a.price;
    temp.name=a.name;
    a.gender=b.gender;
    a.type=b.type;
    a.small=b.small;
    a.large=b.large;
    a.brand=b.brand;
    a.price=b.price;
    a.name=b.name;
    b.gender=temp.gender;
    b.type=temp.type;
    b.small=temp.small;
    b.large=temp.large;
    b.brand=temp.brand;
    b.price=temp.price;
    b.name=temp.name;
}

function display_content(pagesize, totalnumber, order)//display page content
{
    //reorder object array
    if(order=='increase')
    {
        
        for(i=0;i<totalnumber-1;i++)
        {
            for(j=i+1;j<totalnumber;j++)
            {
                m=parseInt(arr[i].price.substr(3));
                n=parseInt(arr[j].price.substr(3));
                if(m>n)
                    swap(arr[i],arr[j]);
            }
        }
    }
    else if(order=='decrease')
    {
        for(i=0;i<totalnumber-1;i++)
        {
            for(j=i+1;j<totalnumber;j++)
            {
                m=parseInt(arr[i].price.substr(3));
                n=parseInt(arr[j].price.substr(3));
                if(m<n)
                    swap(arr[i],arr[j]);
            }
        }
    }
    //recalculate total number according to selected brands
    if(brand_arr.length!=0)
    {
        totalnumber=0;
        for(var i=0;i<arr.length;i++)
        {
            if(brand_belongs(arr[i].brand)==true)
            {
                totalnumber++;
            }
        }
    }
    //generate page number, display at bottom

    pagenumber=Math.ceil(totalnumber/pagesize);
    c="<li><a >&laquo;</a></li>";
    for(i=0;i<pagenumber;i++)
    {
        j=i+1;
        if(j==1)
            c = c + "<li class='active'><a href='javascript:go_to_page(" + j + "," + pagenumber + "," + pagesize + ")'>" + j + "</a></li>";
        else
            c = c + "<li><a href='javascript:go_to_page(" + j + "," + pagenumber + "," + pagesize + ")'>" + j + "</a></li>";
    }
    if(pagenumber>1)
    c = c + "<li><a href='javascript:go_to_page(" + 2 + "," + pagenumber + "," + pagesize + ")'>&raquo;</a></li>";
    else
    c = c + "<li><a >&raquo;</a></li>";
    document.getElementById('pg').innerHTML = c;
    //display page content
    document.getElementById("rp").innerHTML='';
    size=0;

    for(var i=0;i<arr.length;i++)
    {
            if(brand_belongs(arr[i].brand)==true)
            {
                s = document.getElementById("rp").innerHTML;
                s = s + "<div class='col-md-4 col-sm-6'><div class='product'><div class='flip-container'><div class='flipper'><div class='front'><a href='detail.php?name=";
                s = s + arr[i].name;
                s = s + "'><img src='";
                s = s + "img/img/";
                s = s + arr[i].small;
                s = s + "' alt='";
                s = s + arr[i].name;
                s = s + "' class='img-responsive'></a></div><div class='back'><a href='detail.php?name=";
                s = s + arr[i].name;
                s = s + "'><img src='";
                s = s + "img/img/";
                s = s + arr[i].large;
                s = s + "' alt='";
                s = s + arr[i].name;
                s = s + "' class='img-responsive'></a></div></div></div><a href='detail.php?name=";
                s = s + arr[i].name;
                s = s + "' class='invisible'><img src='";
                s = s + "img/img/";
                s = s + arr[i].small;
                s = s + "' alt='";
                s = s + arr[i].name;
                s = s + "' class='img-responsive'></a><div class='text'><h3><a href='detail.php?name=";
                s = s + arr[i].name;
                s = s + "'>";
                s = s + arr[i].name;
                s = s + "</a></h3><p class='price'>";
                s = s + arr[i].price;
                s = s + "</p><p class='buttons'><a href='detail.php?name=";
                s = s + arr[i].name;
                s = s + "' class='btn btn-default'>View detail</a><a id='";
                s = s + arr[i].name;
                s = s + "' class='btn btn-primary' onclick='add_to_cart(this.id)'><i class='fa fa-shopping-cart'></i>Add to cart</a></p></div></div></div>";
                document.getElementById("rp").innerHTML=s;
                size++;
                if(size==pagesize)
                {
                    break;
                }
            }
            
    }
    info='Showing <strong>'+min(pagesize,totalnumber)+'</strong> of <strong>'+totalnumber+'</strong> products';
    document.getElementById('product_info').innerHTML=info;
}

function change_brand_array()//get brand selection information
{
    brand_arr.splice(0,brand_arr.length);
    // document.getElementById('Versace').checked=true;
    // brands=document.form[2].brands;
    // alert(brands);
    // for (i=0;i<brands.length;++ i)
    // {
    //     if(brands[i].checked)
    // // alert('12');
    //         {
    //             brand_arr[brand_arr.length]=brands[i];
    //             alert(brands[i]);
    //         }
    // // alert('12');
    // }

    if(document.getElementById('Armani').checked)
    {
        brand_arr.push('Armani');
    }
    if(document.getElementById('Versace').checked)
    {
        brand_arr.push('Versace');
    }
    if(document.getElementById('JackHoney').checked)
    {
        brand_arr.push('Jack Honey');
    }
    if(document.getElementById('CarloBruni').checked)
    {
        brand_arr.push('Carlo Bruni');
    }

    //redisplay item page
    display_content(pagesize,arr.length,display_order);
}

function brand_belongs(brand)//check if a brand belongs to selected brands
{
    if(brand_arr.length==0)
        return true;
    for(i=0;i<brand_arr.length;i++)
    {
        if(brand==brand_arr[i])
            return true;
    }
    return false;
}

function array_delete(item, ar)//delete an item from array
{
    position=-1;
    for(i=0;i<ar.length;i++)
    {
        if(ar[i]==item)
        {
            position=i;
            break;
        }
    }
    if(position!=-1)
        ar.splice(position,1);
}

function generate_page(xmlDoc, pagesize, gender, type)//generate item page
{
    //get element number and page number
    x=xmlDoc.getElementsByTagName("item");
    size=0;
    totalnumber=0;
    ladies=0;
    men=0;
    for(i=0;i<x.length;i++)
    {
        if(xmlDoc.getElementsByTagName("gender")[i].childNodes[0].nodeValue=='Lady')
        ladies++;
        else if(xmlDoc.getElementsByTagName("gender")[i].childNodes[0].nodeValue=='Men')
        men++;
    }

    arr.splice(0,arr.length);

    var subtype=null;
    if(type=='Bags'||type=='Belts')
    {
        subtype=type;
        type='Accessories';
    }


    if(gender!=null&&type!=null)
    {
        for(var i=0;i<x.length;i++)
        {
            if(xmlDoc.getElementsByTagName("gender")[i].childNodes[0].nodeValue==gender&&xmlDoc.getElementsByTagName("type")[i].childNodes[0].nodeValue==type)
            {
                if(type=='Accessories'&&subtype!=null&&subtype!=xmlDoc.getElementsByTagName('type')[i].getAttribute('subtype'))
                    continue;
                totalnumber++;
                temp=new Object;
                temp.gender=xmlDoc.getElementsByTagName("gender")[i].childNodes[0].nodeValue;
                temp.type=xmlDoc.getElementsByTagName("type")[i].childNodes[0].nodeValue;
                temp.small=xmlDoc.getElementsByTagName("small")[i].childNodes[0].nodeValue;
                temp.large=xmlDoc.getElementsByTagName("large")[i].childNodes[0].nodeValue;
                temp.name=xmlDoc.getElementsByTagName("name")[i].childNodes[0].nodeValue;
                temp.brand=xmlDoc.getElementsByTagName("brand")[i].childNodes[0].nodeValue;
                temp.price=xmlDoc.getElementsByTagName("price")[i].childNodes[0].nodeValue;
                arr[totalnumber-1]=temp;
            }
        }
    }
    if(gender==null&&type!=null)
    {

        for(var i=0;i<x.length;i++)
        {
            if(xmlDoc.getElementsByTagName("type")[i].childNodes[0].nodeValue==type)
            {
                if(type=='Accessories'&&subtype!=xmlDoc.getElementsByTagName('type')[i].getAttribute('subtype'))
                    continue;
                totalnumber++;
                temp=new Object;
                temp.gender=xmlDoc.getElementsByTagName("gender")[i].childNodes[0].nodeValue;
                temp.type=xmlDoc.getElementsByTagName("type")[i].childNodes[0].nodeValue;
                temp.small=xmlDoc.getElementsByTagName("small")[i].childNodes[0].nodeValue;
                temp.large=xmlDoc.getElementsByTagName("large")[i].childNodes[0].nodeValue;
                temp.brand=xmlDoc.getElementsByTagName("brand")[i].childNodes[0].nodeValue;
                temp.price=xmlDoc.getElementsByTagName("price")[i].childNodes[0].nodeValue;
                temp.name=xmlDoc.getElementsByTagName("name")[i].childNodes[0].nodeValue;
                arr[totalnumber-1]=temp;
            }
        }
    }
    if(gender!=null&&type==null)
    {

        for(var i=0;i<x.length;i++)
        {
            if(xmlDoc.getElementsByTagName("gender")[i].childNodes[0].nodeValue==gender)
            {
                totalnumber++;
                temp=new Object;
                temp.gender=xmlDoc.getElementsByTagName("gender")[i].childNodes[0].nodeValue;
                temp.type=xmlDoc.getElementsByTagName("type")[i].childNodes[0].nodeValue;
                temp.small=xmlDoc.getElementsByTagName("small")[i].childNodes[0].nodeValue;
                temp.large=xmlDoc.getElementsByTagName("large")[i].childNodes[0].nodeValue;
                temp.brand=xmlDoc.getElementsByTagName("brand")[i].childNodes[0].nodeValue;
                temp.name=xmlDoc.getElementsByTagName("name")[i].childNodes[0].nodeValue;
                temp.price=xmlDoc.getElementsByTagName("price")[i].childNodes[0].nodeValue;
                arr[totalnumber-1]=temp;
            }
        }
    }
    if(gender==null&&type==null)
    {
        for(var i=0;i<x.length;i++)
        {   
            totalnumber++;
            temp=new Object;
            temp.gender=xmlDoc.getElementsByTagName("gender")[i].childNodes[0].nodeValue;
            temp.type=xmlDoc.getElementsByTagName("type")[i].childNodes[0].nodeValue;
            temp.small=xmlDoc.getElementsByTagName("small")[i].childNodes[0].nodeValue;
            temp.large=xmlDoc.getElementsByTagName("large")[i].childNodes[0].nodeValue;
            temp.brand=xmlDoc.getElementsByTagName("brand")[i].childNodes[0].nodeValue;
            temp.name=xmlDoc.getElementsByTagName("name")[i].childNodes[0].nodeValue;
            temp.price=xmlDoc.getElementsByTagName("price")[i].childNodes[0].nodeValue;
            arr[totalnumber-1]=temp;
        }
    }

    pagenumber=Math.ceil(totalnumber/pagesize);


    //update product infomation

    document.getElementById('num_men').innerHTML=men;
    document.getElementById('num_ladies').innerHTML=ladies;

    //brand number
    var armani=0;
    var versace=0;
    var carlobruni=0;
    var jackhoney=0;
    for(var i=0;i<arr.length;i++)
    {
        if(arr[i].brand=='Armani')
            armani++;
        else if(arr[i].brand=='Versace')
            versace++;
        else if(arr[i].brand=='Carlo Bruni')
            carlobruni++;
        else if(arr[i].brand=='Jack Honey')
            jackhoney++;
    }
    document.getElementById('Armani_label').innerHTML="<input type='checkbox' name='brands' id='Armani'>Armani ("+armani+")";
    document.getElementById('Versace_label').innerHTML="<input type='checkbox' name='brands' id='Versace'>Versace ("+versace+")";
    document.getElementById('CarloBruni_label').innerHTML="<input type='checkbox' name='brands' id='CarloBruni'>Carlo Bruni ("+carlobruni+")";
    document.getElementById('JackHoney_label').innerHTML="<input type='checkbox' name='brands' id='JackHoney'>Jack Honey ("+jackhoney+")";

    //display page content
    display_content(pagesize, totalnumber, 'increase');


}

function go_to_page(current_page,pagenumber,pagesize)
{
    
    size=0;

    //generate page number, display at bottom
    last_page=current_page-1;
    if(current_page==1)
    c="<li><a >&laquo;</a></li>";
    else
    c="<li><a href='javascript:go_to_page(" + last_page + "," + pagenumber + "," + pagesize + ")'>&laquo;</a></li>";
    for(i=0;i<pagenumber;i++)
    {
        j=i+1;
        if(j==current_page)
            c = c + "<li class='active'><a href='javascript:go_to_page(" + j + "," + pagenumber + "," + pagesize + ")'>" + j + "</a></li>";
        else
            c = c + "<li><a href='javascript:go_to_page(" + j + "," + pagenumber + "," + pagesize + ")'>" + j + "</a></li>";
    }
    next_page=current_page+1;
    if(pagenumber>1&&current_page!=pagenumber)
    c = c + "<li><a href='javascript:go_to_page(" + next_page + "," + pagenumber + "," + pagesize + ")'>&raquo;</a></li>";
    else
    c = c + "<li><a >&raquo;</a></li>";
    document.getElementById('pg').innerHTML = c;

    //display page content
    document.getElementById("rp").innerHTML='';
    num=0;
    for(var i=0;i<arr.length;i++)
    {
        if(brand_belongs(arr[i].brand)==false)
            continue;
        if(num++<(current_page-1)*pagesize)
            continue;
            s = document.getElementById("rp").innerHTML;
            s = s + "<div class='col-md-4 col-sm-6'><div class='product'><div class='flip-container'><div class='flipper'><div class='front'><a href='detail.php?name=";
            s = s + arr[i].name;
            s = s + "'><img src='";
            s = s + "img/img/";
            s = s + arr[i].small;
            s = s + "' alt='";
            s = s + arr[i].name;
            s = s + "' class='img-responsive'></a></div><div class='back'><a href='detail.php?name=";
            s = s + arr[i].name;
            s = s + "'><img src='";
            s = s + "img/img/";
            s = s + arr[i].large;
            s = s + "' alt='";
            s = s + arr[i].name;
            s = s + "' class='img-responsive'></a></div></div></div><a href='detail.php?name=";
            s = s + arr[i].name;
            s = s + "' class='invisible'><img src='";
            s = s + "img/img/";
            s = s + arr[i].small;
            s = s + "' alt='";
            s = s + arr[i].name;
            s = s + "' class='img-responsive'></a><div class='text'><h3><a href='detail.php?name=";
            s = s + arr[i].name;
            s = s + "'>";
            s = s + arr[i].name;
            s = s + "</a></h3><p class='price'>";
            s = s + arr[i].price;
            s = s + "</p><p class='buttons'><a href='detail.php?name=";
            s = s + arr[i].name;
            s = s + "' class='btn btn-default'>View detail</a><a id='";
            s = s + arr[i].name;
            s = s + "' class='btn btn-primary' onclick='add_to_cart(this.id)'><i class='fa fa-shopping-cart'></i>Add to cart</a></p></div></div></div>";
            document.getElementById("rp").innerHTML=s;
            size++;
            if(size==pagesize)
                break;
    }

    var total=0;
    for(var i=0;i<arr.length;i++)
    {
        if(brand_belongs(arr[i].brand))
            total++;
    }

    //update product infomation
    info='Showing <strong>'+size+'</strong> of <strong>'+total+'</strong> products';
    document.getElementById('product_info').innerHTML=info;
    window.location.href='#top';
}

function selection_clear()//for button clear
{
    document.getElementById('JackHoney').checked=false;
    document.getElementById('Versace').checked=false;
    document.getElementById('Armani').checked=false;
    document.getElementById('CarloBruni').checked=false;
    //redisplay item page
    change_brand_array();
}

function category_lady(id)
{
    if(id==1)
        type='T-Shirts';
    else if(id==2)
        type='Shirts';
    else if(id==3)
        type='Pants';
     else if(id==4)//bag
    {
        generate_page(getxml(), 6, 'Lady', 'Accessories');
        for(i=0;i<arr.length;i++)
        {
            str=arr[i].name.toLowerCase();
            if(str.match('belt')!=null)
            {
                arr.splice(i,1);
                i--;
            }
        }
        display_content(6,arr.length,'increase');
        return;
    }
    else if(id==5)
    {
        generate_page(getxml(), 6, 'Lady', 'Accessories');
        for(i=0;i<arr.length;i++)
        {
            str=arr[i].name.toLowerCase();
            if(str.match('belt')==null)
            {
                arr.splice(i,1);
                i--;
            }
        }
        display_content(6,arr.length,'increase');
        return;
    }
    else if(id==6)
        type='Accessories';

    xmlDoc=getxml();
    // window.location.href='category-lady.php';
    generate_page(xmlDoc, 6, 'Lady', type);
    document.getElementById('bx').innerHTML="<h1>Ladies</h1><p>In our Ladies department we offer wide selection of the best products we have found and carefully selected worldwide.</p>";
}

function category_men(id)
{
    if(id==1)
        type='T-Shirts';
    else if(id==2)
        type='Shirts';
    else if(id==3)
        type='Pants';
    else if(id==4)//bag
    {
        generate_page(getxml(), 6, 'Men', 'Accessories');
        for(i=0;i<arr.length;i++)
        {
            str=arr[i].name.toLowerCase();
            if(str.match('belt')!=null)
                arr.splice(i,1);
        }
        display_content(6,arr.length,'increase');
        return;
    }
    else if(id==5)
    {
        generate_page(getxml(), 6, 'Men', 'Accessories');
        for(i=0;i<arr.length;i++)
        {
            str=arr[i].name.toLowerCase();
            if(str.match('belt')==null)
                arr.splice(i,1);
        }
        display_content(6,arr.length,'increase');
        return;
    }
    else if(id==6)
        type='Accessories';

    xmlDoc=getxml();
    // window.location.href='category-lady.php';
    generate_page(xmlDoc, 6, 'Men', type);
    document.getElementById('bx').innerHTML="<h1>Men</h1><p>In our Men department we offer wide selection of the best products we have found and carefully selected worldwide.</p>";
}

function change_pagesize(size)//change page size(6, 12 and all)
{
    info='Showing <strong>'+min(arr.length,size)+'</strong> of <strong>'+arr.length+'</strong> products';
    document.getElementById('product_info').innerHTML=info;
    display_content(size, arr.length, display_order);
    pagesize=size;
    if(size==6)
    document.getElementById('change_page_size').innerHTML="<strong>Show</strong>  <a href='javascript:change_pagesize(6)' class='btn btn-default btn-sm btn-primary'>6</a>  <a href='javascript:change_pagesize(12)' class='btn btn-default btn-sm'>12</a>  <a href='javascript:change_pagesize(50)' class='btn btn-default btn-sm'>All</a> products";
    else if(size==12)
    document.getElementById('change_page_size').innerHTML="<strong>Show</strong>  <a href='javascript:change_pagesize(6)' class='btn btn-default btn-sm'>6</a>  <a href='javascript:change_pagesize(12)' class='btn btn-default btn-sm btn-primary'>12</a>  <a href='javascript:change_pagesize(50)' class='btn btn-default btn-sm'>All</a> products";
    else
    document.getElementById('change_page_size').innerHTML="<strong>Show</strong>  <a href='javascript:change_pagesize(6)' class='btn btn-default btn-sm'>6</a>  <a href='javascript:change_pagesize(12)' class='btn btn-default btn-sm'>12</a>  <a href='javascript:change_pagesize(50)' class='btn btn-default btn-sm btn-primary'>All</a> products";

    
}

function change_order()//change display order
{
    if(display_order=='increase')
    {
        display_content(pagesize, arr.length, 'decrease');
        display_order='decrease';
    }
    else if(display_order='decrease')
    {
        display_content(pagesize, arr.length, 'increase');
        display_order='increase';
    }
}

function add_to_cart(id)
{
    var name=id;
    for(var i=0;i<arr.length;i++)
    {
        if(arr[i].name==name)
        {
            var price=arr[i].price;
            var path=arr[i].small;
            var url='detail.php?name='+name;
            path='img/img/'+path;
            price=price.substr(3);

            var xmlhttp;
            if (window.XMLHttpRequest)
            {// code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp=new XMLHttpRequest();
            }
            else
            {// code for IE6, IE5
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function()
            {
                if (xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                    if(xmlhttp.responseText!='')//success
                    {
                        // document.getElementById('old_pass_error').innerHTML='';
                        document.getElementById('cart_info_1').innerHTML=xmlhttp.responseText;
                        document.getElementById('cart_info_2').innerHTML=xmlhttp.responseText;
                    }
                    // else
                        // document.getElementById('old_pass_error').innerHTML='wrong password, please type it again';
                }
            }
            xmlhttp.open( 'POST', 'add_to_basket.php', true );
            xmlhttp.setRequestHeader( 'Content-Type', 'application/x-www-form-urlencoded' );
            xmlhttp.send('name='+name+'&path='+path+'&url='+url+'&price='+price);



            return;
        }
    }
}

