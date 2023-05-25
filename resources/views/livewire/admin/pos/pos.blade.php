<div style="height: 620px" class="w-full text-sky-900 overflow-y-auto">
    <div class="grid grid-cols-4 m-4 p-4 bg-white rounded-md shadow-md">
        {{-- details --}}
        <div class="col-span-3">
            <div class=" p-2 w-full h-full bg-slate-200 rounded-md shadow-md ">
                @include('livewire.admin.pos.partials.details')
            </div>
        </div>
        {{-- total --}}
        <div class="col-span-1 text-sm">
            <div class=" mx-2 mb-2 w-full -h-full bg-slate-200 rounded-md shadow-md">
            {{-- total --}}
                @include('livewire.admin.pos.partials.total')
            </div>
            {{-- coins --}}
            <div class=" mx-2 mt-2 w-full -h-full bg-slate-200 rounded-md shadow-md">
                @include('livewire.admin.pos.partials.coins')
            </div>
            {{-- Cahnge --}}
            <div class=" mx-2 mb-2 w-full -h-full bg-slate-200 rounded-md shadow-md">
                {{-- total --}}
                @include('livewire.admin.pos.partials.change')
            </div>
        </div>
        

    </div>
    <div class="w-full h-24 bg-white">
        BOTTOM
    </div>

    <script>
        window.addEventListener('NewWindowPrintTicket', event => {
            //console.log(event.detail.saleId);
            myReceiptWindow = window.open("sale/print-ticket?selectedId="+event.detail.saleId,"myWin", "left=150, top=130, width=400, height=600");
            myReceiptWindow.screnX = 100;
            myReceiptWindow.screnY = 100;
            myReceiptWindow.document.write(data);
            myReceiptWindow.document.title = "Imprimir Ticket";
            myReceiptWindow.focus();
        })

    </script>
</div>


