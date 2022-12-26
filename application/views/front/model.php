<div class="searchBar">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-offset-2 col-sm-8 col-md-offset-3 col-md-6">
                <div class="searchForm">
                    <span id="searchLabel">الخطوة الاولي</span>
                    <div class="searchField">
                    <p>لطفا اختر موديل السيارة و سنة تصنيعها</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
            
<div class="dropdownList-outer">            	
    <div class="dropdownList">
        <select id="car-modal" name="car-modal">
            <? foreach($models->result() as $data){?>
                <option>موديل السيارة</option>
                <option><?=$data->name?></option>
            <?}?>
        </select>
    </div>
    <div class="dropdownList">
        <select id="modal-date" name="modal-date">
            <option>سنة التصنيع</option>
            <option>١٩٩٠</option>
            <option>١٩٩١</option>
            <option>١٩٩٢</option>
            <option>١٩٩٣</option>
            <option>١٩٩٤</option>
            <option>١٩٩٥</option>
            <option>١٩٩٦</option>
            <option>١٩٩٧</option>
            <option>١٩٩٨</option>
            <option>١٩٩٩</option>
            <option>٢٠٠٠</option>
            <option>٢٠٠١</option>
            <option>٢٠٠٢</option>
            <option>٢٠٠٣</option>
            <option>٢٠٠٤</option>
            <option>٢٠٠٥</option>
            <option>٢٠٠٦</option>
            <option>٢٠٠٧</option>
            <option>٢٠٠٨</option>
            <option>٢٠٠٩</option>
            <option>٢٠١٠</option>
            <option>٢٠١٢</option>
            <option>٢٠١٣</option>
            <option>٢٠١٤</option>
            <option>٢٠١٥</option>
            <option>٢٠١٦</option>
            <option>٢٠١٧</option>
            <option>٢٠١٨</option>
            <option>٢٠١٩</option>
        </select>
    </div>
</div>
<div class="pagination">    
    <a href="#" class="prev"> السابق <</a>
    <a href="#" class="next">التالي  ></a>
</div>

