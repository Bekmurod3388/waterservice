<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Taxrirlash</h5>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            <div id="md-body" class="modal-body">

            </div>
        </div>
    </div>
</div>

<script>
    let operators = @json($operators);
    let cashiers = @json($cashiers);
    let responsible = @json($responsible)["data"];
    let default_url="{{ route('responsible.update', 0) }}";

    function findData(id){
        for (let i = 0; i < responsible.length; i++) {
            if(responsible[i]["id"]===id){
                return responsible[i];
            }
        }
    }
    function UpdateUrl(id) {
        return default_url.slice(0, -1) + id;
    }

    function editModal(id){
        let url = UpdateUrl(id);
        let data=findData(id);

        let modalHTML =
            `
                <form method="POST" action="${url}">
                    @csrf
                    @method('PUT')


                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="operator_id" class="form-label">Operatorni tanlang</label><br>
                            <select id="operator_id" class="form-control" name="operator_id" required>
            `
        operators.forEach(operator => {
            modalHTML += `
                                <option value="${operator["id"]}" ${(data["operator_id"] === operator["id"]) ? 'selected' : ''}>
                                    ${ operator["name"] }
                                </option>
                        `;
        });
        modalHTML+=`
                            </select>
                        </div>
                    </div>

                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="cashier_id" class="form-label">Kassirni tanlang</label><br>
                            <select id="cashier_id" class="form-control" name="cashier_id" required>`
        cashiers.forEach(cashier => {
            modalHTML += `
                                <option value="${cashier["id"]}" ${(data["cashier_id"] === cashier["id"]) ? 'selected' : ''}>
                                    ${ cashier["name"] }
                                </option>
                        `;
        });
        modalHTML+=`
                            </select>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="month" class="form-label">  Oyi </label>
                            <input type="month" id="month" class="form-control" name="month" value="${data['month']}" required/>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Yopish</button>
                        <button type="submit" class="btn btn-primary">Saqlash</button>
                    </div>
                </form>
            `


        document.getElementById('md-body').innerHTML = modalHTML;
    }

</script>
