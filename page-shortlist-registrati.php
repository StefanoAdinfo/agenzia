<?php
get_header(); ?>



<!-- class="it-header-slim-wrapper" -->
<div>
    <div class="container">
        <!-- Parte superiore -->
        <!-- <div class="row">
            <div class="col-12">
                <div class="it-header-slim-wrapper-content">
                    <a class="d-none d-lg-block navbar-brand" href="https://www.agenziaareanolana.it/">Agenzia Area Nolana</a>
                    <div class="nav-mobile">
                        <nav>
                            <a class="it-opener d-lg-none" data-toggle="collapse" href="#menu1" role="button" aria-expanded="false" aria-controls="menu1">
                                <span>Agenzia Area Nolana</span>
                                <svg class="icon">
                                    <use xlink:href="/bootstrap-italia/dist/svg/sprite.svg#it-expand"></use>
                                </svg>
                            </a>
                        </nav>
                    </div>

                </div>
            </div>
        </div> -->
        <div class="it-hero-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="it-hero-text-wrapper bg-dark">
                            <span class="it-category">AGENZIA AREA NOLANA</span>
                            <h1 class="no_toc">SHORTLIST<br>ASSISTENTI SOCIALI</h1>
                            <p class="d-none d-lg-block">AVVISO PUBBLICO PER LA COSTITUZIONE DI UNA SHORT LIST FIGURE PROFESSIONALI SOCIALI CUI CONFERIRE INCARICHI AI SENSI DELL'ART. 36 - COMMA 2, LETT. A), DEL D. LGS. 50/2016 PER ATTIVITÀ DI PIANIFICAZIONE, ATTUAZIONE E GESTIONE DEGLI INTERVENTI AFFERENTI ALLA PROGRAMMAZIONE SOCIALE E SOCIO SANITARIA DELL' AMBITO TERRITORIALE N 23</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Form -->
        <form id="registrazione-form" class="needs-validation mt-5" name="resistrati" method="post" enctype="multipart/form-data" novalidate="">

            <input type="hidden" name="token" value="79c7fc91bbe1103ca882c7b66b61771b0ed363da">

            <div class="container">
                <p><b>Profilo</b></p>
                <hr>

                <fieldset id="checkgroup" class="row mt-5">
                    <label for="checkgroup" class="active mb-3">Seleziona il tuo profilo professionale</label>
                    <div class="col-md-3">
                        <div class="form-check">
                            <input
                                id="assistente_sociale"
                                type="checkbox"
                                class="form-check-input"
                                name="profilo[]"
                                value="assistente_sociale"
                                required
                                data-focus-mouse="false">
                            <label for="assistente_sociale" class="form-check-label">Assistente Sociale</label>
                        </div>
                    </div>

                    <!-- <div class="col-md-3">
                        <div class="form-check">
                            <input
                                id="operatore_ABA"
                                type="checkbox"
                                class="form-check-input"
                                name="profilo[]"
                                value="operatore_ABA"
                                required
                                data-focus-mouse="false">
                            <label for="operatore_ABA" class="form-check-label">Operatore ABA</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-check">
                            <input
                                id="operatori_allassistenza_educativa_ai_disabili"
                                type="checkbox"
                                class="form-check-input"
                                name="profilo[]"
                                value="operatori_allassistenza_educativa_ai_disabili"
                                required
                                data-focus-mouse="false">
                            <label for="operatori_allassistenza_educativa_ai_disabili" class="form-check-label">
                                Operatori all’assistenza educativa ai disabili
                            </label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-check">
                            <input
                                id="assistente_alla_comunicazione"
                                type="checkbox"
                                class="form-check-input"
                                name="profilo[]"
                                value="assistente_alla_comunicazione"
                                required
                                data-focus-mouse="false">
                            <label for="assistente_alla_comunicazione" class="form-check-label">Assistente alla comunicazione</label>
                        </div>
                    </div> -->
                </fieldset>

                <div class="row mt-5">
                    <div class="form-group col-md-6">
                        <label for="nome">Nome</label>
                        <input type="text" name="nome" class="form-control" id="nome" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="cognome">Cognome</label>
                        <input type="text" name="cognome" class="form-control" id="cognome" required>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" id="email" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="telefono">Telefono</label>
                        <input type="tel" name="telefono" class="form-control" id="telefono" required>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="data_nascita" class="active">Data di Nascita</label>
                        <input type="date" name="data_nascita" class="form-control" id="data_nascita" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="luogo_nascita">Luogo di Nascita</label>
                        <input type="text" name="luogo_nascita" class="form-control" id="luogo_nascita" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="codice_fiscale">Codice Fiscale</label>
                        <input type="text" name="codice_fiscale" class="form-control" id="codice_fiscale" onkeyup="this.value = this.value.toUpperCase();" required>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="luogo_residenza">Luogo di Residenza</label>
                        <input type="text" name="luogo_residenza" class="form-control" id="luogo_residenza" required>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <div class="select-wrapper">
                            <label class="active">Laurea</label>
                            <select class="form-control" id="laurea" title="Scegli una opzione" required>
                                <option value="">seleziona</option>
                                <option value="triennale">LAUREA TRIENNALE</option>
                                <option value="magistrale">LAUREA MAGISTRALE</option>
                                <option value="specialistica">LAUREA SPECIALISTICA</option>
                                <option value="vecchio ordinamento">LAUREA VECCHIO ORDINAMENTO</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="laurea_in">Laurea in</label>
                        <input type="text" name="laurea_in" class="form-control" id="laurea_in" required>
                    </div>
                </div>



                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="universita">Università</label>
                        <input type="text" name="universita" class="form-control" id="universita" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="data_conseguimento" class="active">Data conseguimento</label>
                        <input type="date" name="data_conseguimento" class="form-control" id="data_conseguimento" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="votazione">Votazione</label>
                        <input type="number" name="votazione" class="form-control" id="votazione" required>
                    </div>
                </div>

                <p><b>Eventuale altra Laurea</b></p>
                <hr>

                <div class="row mt-5">
                    <div class="form-group col-md-6">
                        <div class="select-wrapper">
                            <label class="active">Laurea</label>
                            <select id="laurea2" class="form-control" title="Scegli una opzione">
                                <option value="">seleziona</option>
                                <option value="triennale">LAUREA TRIENNALE</option>
                                <option value="magistrale">LAUREA MAGISTRALE</option>
                                <option value="specialistica">LAUREA SPECIALISTICA</option>
                                <option value="vecchio ordinamento">LAUREA VECCHIO ORDINAMENTO</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="laurea_in2">Laurea in</label>
                        <input type="text" name="laurea_in2" class="form-control" id="laurea_in2">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="universita2">Università</label>
                        <input type="text" name="universita2" class="form-control" id="universita2">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="data_conseguimento2" class="active">Data conseguimento</label>
                        <input type="date" name="data_conseguimento2" class="form-control" id="data_conseguimento2">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="votazione2">Votazione</label>
                        <input type="number" name="votazione2" class="form-control" id="votazione2">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-12">
                        <div class="select-wrapper">
                            <label class="active">Iscrizione ad albo professionale</label>
                            <select class="form-control" id="albo" title="Scegli una opzione" required>
                                <option value="">seleziona</option>
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <div class="select-wrapper">
                            <label class="active">Master</label>
                            <select class="form-control" id="master" title="Scegli una opzione" required>
                                <option value="">seleziona</option>
                                <option value="NESSUNO">NESSUNO</option>
                                <option value="MASTER I LIVELLO">MASTER I LIVELLO</option>
                                <option value="MASTER II LIVELLO">MASTER II LIVELLO</option>
                                <option value="CORSO DI SPECIALIZZAZIONE">CORSO DI SPECIALIZZAZIONE</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="titolo_master">TITOLO MASTER/CORSO</label>
                        <input type="text" name="titolo_master" class="form-control" id="titolo_master">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="data_master" class="active">Data conseguimento master</label>
                        <input type="date" name="data_master" class="form-control" id="data_master">
                    </div>
                </div>

                <p><b>Eventuale altro Master</b></p>
                <hr><br>

                <div class="row">
                    <div class="form-group col-md-4">
                        <div class="select-wrapper">
                            <label class="active">Master</label>
                            <select class="form-control" id="master2" title="Scegli una opzione" required>
                                <option value="">seleziona</option>
                                <option value="NESSUNO">NESSUNO</option>
                                <option value="MASTER I LIVELLO">MASTER I LIVELLO</option>
                                <option value="MASTER II LIVELLO">MASTER II LIVELLO</option>
                                <option value="CORSO DI SPECIALIZZAZIONE">CORSO DI SPECIALIZZAZIONE</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="titolo_master2">TITOLO MASTER/CORSO</label>
                        <input type="text" name="titolo_master2" class="form-control" id="titolo_master2">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="data_master2" class="active">Data conseguimento master</label>
                        <input type="date" name="data_master2" class="form-control" id="data_master2">
                    </div>
                </div>


                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="altre_attestazioni">Altre attestazioni</label>
                        <input type="text" name="altre_attestazioni" class="form-control" id="altre_attestazioni">
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="form-group col-md-4">
                        <div class="select-wrapper">
                            <label class="active lh-base">
                                Esperienze in pubbliche amministrazioni <br />
                                negli ultimi 3 anni
                            </label>
                            <select class="form-control" id="esperienza_pa" title="Scegli una opzione" required>
                                <option value="">seleziona</option>
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="ente_pa">Se SI indicare ENTE</label>
                        <input type="text" name="ente_pa" class="form-control" id="ente_pa">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="durata_pa">Se SI indicare la durata in mesi</label>
                        <input type="number" name="durata_pa" class="form-control" id="durata_pa">
                    </div>
                </div>

                <div class="row">
                    <div class="form-upload col-md-12">
                        <label for="immagine" class="active">Allega Curriculum</label>
                        <input type="file" name="immagine" class="form-control" id="immagine" accept=".doc,.docx,.pdf" required>
                    </div>
                </div>


                <!-- parte finale -->

                <div class="row align-items-center text-center mb-5 mt-3">
                    <div class="col-md-12 ">
                        <div class="form-check mt-0">
                            <input class="form-check-input" type="checkbox" value="" id="checkbox1" name="privacy" required>
                            <label class="form-check-label" for="checkbox1">Accetto le condizioni di registrazione e l'informativa sul trattamento dei dati personali <a a="" target="_blank" href="https://www.agenziaareanolana.it/privacy"> Privacy </a></label>
                        </div>
                    </div>
                    <div class="col-md-12 mt-4">
                        <button class="btn btn-primary px-5" type="submit">Conferma Registrazione</button>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <div aria-live="polite" id="errorMsgContainer"></div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <style>
        .active {
            color: hsl(210, 17%, 44%) !important;
            ;
        }
    </style>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" crossorigin="anonymous"></script>
    <script src="./js/bootstrap-italia.min.js"></script>


    <script>
        document.addEventListener('DOMContentLoaded', async function() {
            const form = document.getElementById('registrazione-form');
            const errorMessage =
                '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Attenzione</strong> Alcuni campi inseriti sono da controllare.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Chiudi avviso"></div>'
            const errorWrapper = document.querySelector('#errorMsgContainer')
            const validate = new bootstrap.FormValidate('#registrazione-form', {
                errorFieldCssClass: 'is-invalid',
                errorLabelCssClass: 'form-feedback',
                errorLabelStyle: '',
                focusInvalidField: false,
            })

            validate
                .addRequiredGroup('#checkgroup', 'Scegli almeno un’opzione')
                .addField('#nome', [{
                    rule: 'required',
                    errorMessage: 'Questo campo è richiesto'
                }])
                .addField('#cognome', [{
                    rule: 'required',
                    errorMessage: 'Questo campo è richiesto'
                }])
                .addField('#email', [{
                        rule: 'required',
                        errorMessage: 'Questo campo è richiesto',
                    },
                    {
                        rule: 'email',
                        errorMessage: 'Inserire email corretta',
                    },
                ])
                .addField('#telefono', [{
                    rule: 'required',
                    errorMessage: 'Questo campo è richiesto'
                }])
                .addField('#data_nascita', [{
                    rule: 'required',
                    errorMessage: 'Questo campo è richiesto'
                }])
                .addField('#luogo_nascita', [{
                    rule: 'required',
                    errorMessage: 'Questo campo è richiesto'
                }])
                .addField('#codice_fiscale', [{
                        rule: 'required',
                        errorMessage: 'Questo campo è richiesto'
                    },
                    {
                        rule: 'customRegexp',
                        value: "^(?:(?:[B-DF-HJ-NP-TV-Z]|[AEIOU])[AEIOU][AEIOUX]|[B-DF-HJ-NP-TV-Z]{2}[A-Z]){2}[\\dLMNP-V]{2}(?:[A-EHLMPR-T](?:[04LQ][1-9MNP-V]|[1256LMRS][\\dLMNP-V])|[DHPS][37PT][0L]|[ACELMRT][37PT][01LM])(?:[A-MZ][1-9MNP-V][\\dLMNP-V]{2}|[A-M][0L](?:[1-9MNP-V][\\dLMNP-V]|[0L][1-9MNP-V]))[A-Z]$",
                        errorMessage: 'Inserire codice fiscale corretto'
                    }
                ])
                .addField('#luogo_residenza', [{
                    rule: 'required',
                    errorMessage: 'Questo campo è richiesto'
                }])
                .addField('#laurea', [{
                    rule: 'required',
                    errorMessage: 'Seleziona una opzione'
                }])
                .addField('#laurea_in', [{
                    rule: 'required',
                    errorMessage: 'Questo campo è richiesto'
                }])
                .addField('#universita', [{
                    rule: 'required',
                    errorMessage: 'Questo campo è richiesto'
                }])
                .addField('#data_conseguimento', [{
                    rule: 'required',
                    errorMessage: 'Questo campo è richiesto'
                }])
                .addField('#votazione', [{
                    rule: 'required',
                    errorMessage: 'Questo campo è richiesto'
                }])
                .addField('#albo', [{
                    rule: 'required',
                    errorMessage: 'Seleziona una opzione'
                }])
                .addField('#master', [{
                    rule: 'required',
                    errorMessage: 'Seleziona una opzione'
                }])
                .addField('#master2', [{
                    rule: 'required',
                    errorMessage: 'Seleziona una opzione'
                }])
                .addField('#esperienza_pa', [{
                    rule: 'required',
                    errorMessage: 'Seleziona una opzione'
                }])
                .addField('#immagine', [{
                        rule: 'minFilesCount',
                        value: 1,
                        errorMessage: 'Devi allegare un file PDF, DOC o DOCX',
                    },
                    {
                        rule: 'files',
                        value: {
                            files: {
                                extensions: ['pdf', 'doc', 'docx'],
                                maxSize: 5000000,
                            },
                        },
                        errorMessage: 'Formato non valido. Accettiamo solo PDF, DOC o DOCX',
                    }
                ])
                .addField('#checkbox1', [{
                    rule: 'required',
                    errorMessage: 'Questo campo è richiesto'
                }])
                .onSuccess((event) => {
                    form.submit();
                })
                .onFail((fields) => {
                    errorWrapper.innerHTML = ''
                    errorWrapper.innerHTML = errorMessage
                    errorWrapper.scrollIntoView()
                })



        })
    </script>

</div>