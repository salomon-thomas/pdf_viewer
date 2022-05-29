<div class="col-lg-9 col-md-8 text-start">
    <div class="tab-content ms-lg-5" id="v-pills-tabContent">
        <div class="tab-pane fade show active" id="v-pills-one" role="tabpanel" aria-labelledby="v-pills-one-tab">
            <ol class="list-group list mb-3">
                <li class="list-group-item bg-primary text-white d-flex justify-content-between align-items-start pt-lg-3 pb-lg-3">
                    <div class="ms-2 me-auto">
                        <div class="fw-bold text-uppercase"></div>
                        <div class="row">
                            <div class="col-md-1"><a id="logout" href="{{route('logout')}}"><i class="bi bi-box-arrow-left"></i></a></div>
                            <div class="col-md-2"><a id="delete"><i class="bi bi-trash3-fill"></i></a></div>
                            <div class="col-md-8" id="document_title"></div>
                        </div>

                    </div>

                </li>

            </ol>

            <div id="canvas_container">
                <canvas id="pdf_renderer"></canvas>
            </div>
        </div>
    </div>

</div>