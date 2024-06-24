@if ($response == '1')
    <div class="chat__card chat__card--client">
        <div class="chat__message-wrapper" style="--index: 0">
            <div class="chat__message">{{ $value }}</div>
        </div>
    </div>
    <div class="chat__card chat__card--agent">
        <div class="chat__message-wrapper" style="--index: 1">
            <div class="chat__message">Etes vous propriétaire de votre maison ?</div>
        </div>
        <div class="chat__message-wrapper" style="--index: 2">
            <label class="option-btn" role="button">
                <input class="option-btn__input" type="radio" data-response="{{ $response+1 }}" value="Oui" data-toggle="message">
                <span class="option-btn__text">Oui</span>
            </label>
            <label class="option-btn" role="button">
                <input class="option-btn__input" type="radio" data-response="{{ $response+1 }}" value="Non" data-toggle="message">
                <span class="option-btn__text">Non</span>
            </label>
        </div>
    </div>
@elseif($response == '2')
    @if ($value == 'Non')
        <div class="chat__card chat__card--agent">
            <div class="chat__message-wrapper" style="--index: 0">
                <div class="chat__message">Vous n'êtes pas éligible</div>
            </div>
        </div>
    @else
        <div class="chat__card chat__card--client">
            <div class="chat__message-wrapper" style="--index: 0">
                <div class="chat__message">{{ $value }}</div>
            </div>
        </div>
        <div class="chat__card chat__card--agent">
            <div class="chat__message-wrapper" style="--index: 1">
                <div class="chat__message">Combien de personne compose votre foyer ?</div>
            </div>
            <div class="chat__message-wrapper" style="--index: 2">
                <label class="option-btn" role="button">
                    <input class="option-btn__input" type="radio" data-response="{{ $response+1 }}" value="1" data-toggle="message">
                    <span class="option-btn__text">1</span>
                </label>
                <label class="option-btn" role="button">
                    <input class="option-btn__input" type="radio" data-response="{{ $response+1 }}" value="2" data-toggle="message">
                    <span class="option-btn__text">2</span>
                </label>
                <label class="option-btn" role="button">
                    <input class="option-btn__input" type="radio" data-response="{{ $response+1 }}" value="3" data-toggle="message">
                    <span class="option-btn__text">3</span>
                </label>
                <label class="option-btn" role="button">
                    <input class="option-btn__input" type="radio" data-response="{{ $response+1 }}" value="4" data-toggle="message">
                    <span class="option-btn__text">4</span>
                </label>
                <label class="option-btn" role="button">
                    <input class="option-btn__input" type="radio" data-response="{{ $response+1 }}" value="5" data-toggle="message">
                    <span class="option-btn__text">5</span>
                </label>
                <label class="option-btn" role="button">
                    <input class="option-btn__input" type="radio" data-response="{{ $response+1 }}" value="6" data-toggle="message">
                    <span class="option-btn__text">6</span>
                </label>
                <label class="option-btn" role="button">
                    <input class="option-btn__input" type="radio" data-response="{{ $response+1 }}" value="7" data-toggle="message">
                    <span class="option-btn__text">7</span>
                </label>
            </div>
        </div>
    @endif
@elseif($response == '3')
    <div class="chat__card chat__card--client">
        <div class="chat__message-wrapper" style="--index: 0">
            <div class="chat__message">{{ $value }}</div>
        </div>
    </div>
    <div class="chat__card chat__card--agent">
        <div class="chat__message-wrapper" style="--index: 1">
            <div class="chat__message">Quelle est l'estimation de votre revenu fiscale dans votre foyer ? </div>
        </div>
        <div class="chat__message-wrapper" style="--index: 2">
            @switch($value)
                @case(1)
                    @if ($all_value['1'] == 'Non')
                        <label class="option-btn" role="button">
                            <input class="option-btn__input" type="radio" data-response="{{ $response+1 }}" value="Inférieur à 16 229€" data-toggle="message">
                            <span class="option-btn__text">Inférieur à 16 229€</span>
                        </label>
                        <label class="option-btn" role="button">
                            <input class="option-btn__input" type="radio" data-response="{{ $response+1 }}" value="Entre 16 229 € et 20 805€" data-toggle="message">
                            <span class="option-btn__text">Entre 16 229 € et 20 805€</span>
                        </label>
                        <label class="option-btn" role="button">
                            <input class="option-btn__input" type="radio" data-response="{{ $response+1 }}" value="Entre 20 805€ et 29 148€" data-toggle="message">
                            <span class="option-btn__text">Entre 20 805€ et 29 148€</span>
                        </label>
                        <label class="option-btn" role="button">
                            <input class="option-btn__input" type="radio" data-response="{{ $response+1 }}" value="Supérieur à 29 148€" data-toggle="message">
                            <span class="option-btn__text">Supérieur à 29 148€</span>
                        </label>
                    @else
                        <label class="option-btn" role="button">
                            <input class="option-btn__input" type="radio" data-response="{{ $response+1 }}" value="Inférieur à 22 461€" data-toggle="message">
                            <span class="option-btn__text">Inférieur à 22 461€</span>
                        </label>
                        <label class="option-btn" role="button">
                            <input class="option-btn__input" type="radio" data-response="{{ $response+1 }}" value="Entre 22 461 € et 27 343€" data-toggle="message">
                            <span class="option-btn__text">Entre 22 461 € et 27 343€</span>
                        </label>
                        <label class="option-btn" role="button">
                            <input class="option-btn__input" type="radio" data-response="{{ $response+1 }}" value="Entre 27 343€ et 38 184€" data-toggle="message">
                            <span class="option-btn__text">Entre 27 343€ et 38 184€</span>
                        </label>
                        <label class="option-btn" role="button">
                            <input class="option-btn__input" type="radio" data-response="{{ $response+1 }}" value="Supérieur à 38 184€" data-toggle="message">
                            <span class="option-btn__text">Supérieur à 38 184€</span>
                        </label>
                    @endif
                    @break
                @case(2)
                    @if ($all_value['1'] == 'Non')
                        <label class="option-btn" role="button">
                            <input class="option-btn__input" type="radio" data-response="{{ $response+1 }}" value="Inférieur à 23 734€" data-toggle="message">
                            <span class="option-btn__text">Inférieur à 23 734€</span>
                        </label>
                        <label class="option-btn" role="button">
                            <input class="option-btn__input" type="radio" data-response="{{ $response+1 }}" value="Entre 23 734 € et 30 427€" data-toggle="message">
                            <span class="option-btn__text">Entre 23 734 € et 30 427€</span>
                        </label>
                        <label class="option-btn" role="button">
                            <input class="option-btn__input" type="radio" data-response="{{ $response+1 }}" value="Entre 30 427€ et 42 848€" data-toggle="message">
                            <span class="option-btn__text">Entre 30 427€ et 42 848€</span>
                        </label>
                        <label class="option-btn" role="button">
                            <input class="option-btn__input" type="radio" data-response="{{ $response+1 }}" value="Supérieur à 42 848€" data-toggle="message">
                            <span class="option-btn__text">Supérieur à 42 848€</span>
                        </label>
                    @else
                        <label class="option-btn" role="button">
                            <input class="option-btn__input" type="radio" data-response="{{ $response+1 }}" value="Inférieur à 32 967€" data-toggle="message">
                            <span class="option-btn__text">Inférieur à 32 967€</span>
                        </label>
                        <label class="option-btn" role="button">
                            <input class="option-btn__input" type="radio" data-response="{{ $response+1 }}" value="Entre 32 967€ et 40 130€" data-toggle="message">
                            <span class="option-btn__text">Entre 32 967€ et 40 130€</span>
                        </label>
                        <label class="option-btn" role="button">
                            <input class="option-btn__input" type="radio" data-response="{{ $response+1 }}" value="Entre 40 130€ et 56 130€" data-toggle="message">
                            <span class="option-btn__text">Entre 40 130€ et 56 130€</span>
                        </label>
                        <label class="option-btn" role="button">
                            <input class="option-btn__input" type="radio" data-response="{{ $response+1 }}" value="Supérieur à 56 130€" data-toggle="message">
                            <span class="option-btn__text">Supérieur à 56 130€</span>
                        </label>
                    @endif
                    @break
                @case(3)
                    @if ($all_value['1'] == 'Non')
                        <label class="option-btn" role="button">
                            <input class="option-btn__input" type="radio" data-response="{{ $response+1 }}" value="Inférieur à 28 545€" data-toggle="message">
                            <span class="option-btn__text">Inférieur à 28 545€</span>
                        </label>
                        <label class="option-btn" role="button">
                            <input class="option-btn__input" type="radio" data-response="{{ $response+1 }}" value="Entre 28 545 € et 36 591€" data-toggle="message">
                            <span class="option-btn__text">Entre 28 545 € et 36 591€</span>
                        </label>
                        <label class="option-btn" role="button">
                            <input class="option-btn__input" type="radio" data-response="{{ $response+1 }}" value="Entre 36 591€ et 51 592€" data-toggle="message">
                            <span class="option-btn__text">Entre 36 591€ et 51 592€</span>
                        </label>
                        <label class="option-btn" role="button">
                            <input class="option-btn__input" type="radio" data-response="{{ $response+1 }}" value="Supérieur à 51 592€" data-toggle="message">
                            <span class="option-btn__text">Supérieur à 51 592€</span>
                        </label>
                    @else
                        <label class="option-btn" role="button">
                            <input class="option-btn__input" type="radio" data-response="{{ $response+1 }}" value="Inférieur à 39 591€" data-toggle="message">
                            <span class="option-btn__text">Inférieur à 39 591€</span>
                        </label>
                        <label class="option-btn" role="button">
                            <input class="option-btn__input" type="radio" data-response="{{ $response+1 }}" value="Entre 39 591€ et 48 197€" data-toggle="message">
                            <span class="option-btn__text">Entre 39 591€ et 48 197€</span>
                        </label>
                        <label class="option-btn" role="button">
                            <input class="option-btn__input" type="radio" data-response="{{ $response+1 }}" value="Entre 48 197€ et 67 585€" data-toggle="message">
                            <span class="option-btn__text">Entre 48 197€ et 67 585€</span>
                        </label>
                        <label class="option-btn" role="button">
                            <input class="option-btn__input" type="radio" data-response="{{ $response+1 }}" value="Supérieur à 67 585€" data-toggle="message">
                            <span class="option-btn__text">Supérieur à 67 585€</span>
                        </label>
                    @endif
                    @break
                @case(4)
                    @if ($all_value['1'] == 'Non')
                        <label class="option-btn" role="button">
                            <input class="option-btn__input" type="radio" data-response="{{ $response+1 }}" value="Inférieur à 33 346€" data-toggle="message">
                            <span class="option-btn__text">Inférieur à 33 346€</span>
                        </label>
                        <label class="option-btn" role="button">
                            <input class="option-btn__input" type="radio" data-response="{{ $response+1 }}" value="Entre 33 346 € et 42 478€" data-toggle="message">
                            <span class="option-btn__text">Entre 33 346 € et 42 478€</span>
                        </label>
                        <label class="option-btn" role="button">
                            <input class="option-btn__input" type="radio" data-response="{{ $response+1 }}" value="Entre 42 478€ et 60 336€" data-toggle="message">
                            <span class="option-btn__text">Entre 42 478€ et 60 336€</span>
                        </label>
                        <label class="option-btn" role="button">
                            <input class="option-btn__input" type="radio" data-response="{{ $response+1 }}" value="Superieur à 60 336€" data-toggle="message">
                            <span class="option-btn__text">Superieur à 60 336€</span>
                        </label>
                    @else
                        <label class="option-btn" role="button">
                            <input class="option-btn__input" type="radio" data-response="{{ $response+1 }}" value="Inférieur à 46 226€" data-toggle="message">
                            <span class="option-btn__text">Inférieur à 46 226€</span>
                        </label>
                        <label class="option-btn" role="button">
                            <input class="option-btn__input" type="radio" data-response="{{ $response+1 }}" value="Entre 46 226€  et 56 277€" data-toggle="message">
                            <span class="option-btn__text">Entre 46 226€  et 56 277€</span>
                        </label>
                        <label class="option-btn" role="button">
                            <input class="option-btn__input" type="radio" data-response="{{ $response+1 }}" value="Entre 56 277€ et 79 041€" data-toggle="message">
                            <span class="option-btn__text">Entre 56 277€ et 79 041€</span>
                        </label>
                        <label class="option-btn" role="button">
                            <input class="option-btn__input" type="radio" data-response="{{ $response+1 }}" value="Superieur à 79 041€" data-toggle="message">
                            <span class="option-btn__text">Superieur à 79 041€</span>
                        </label>
                    @endif
                    @break
                @case(5)
                    @if ($all_value['1'] == 'Non')
                        <label class="option-btn" role="button">
                            <input class="option-btn__input" type="radio" data-response="{{ $response+1 }}" value="Inférieur à 38 168€" data-toggle="message">
                            <span class="option-btn__text">Inférieur à 38 168€</span>
                        </label>
                        <label class="option-btn" role="button">
                            <input class="option-btn__input" type="radio" data-response="{{ $response+1 }}" value="Entre 38 168€ et 48 930€" data-toggle="message">
                            <span class="option-btn__text">Entre 38 168€ et 48 930€</span>
                        </label>
                        <label class="option-btn" role="button">
                            <input class="option-btn__input" type="radio" data-response="{{ $response+1 }}" value="Entre 48 930€ et 69 081€" data-toggle="message">
                            <span class="option-btn__text">Entre 48 930€ et 69 081€</span>
                        </label>
                        <label class="option-btn" role="button">
                            <input class="option-btn__input" type="radio" data-response="{{ $response+1 }}" value="Superieur à 69 081€" data-toggle="message">
                            <span class="option-btn__text">Superieur à 69 081€</span>
                        </label>
                    @else
                        <label class="option-btn" role="button">
                            <input class="option-btn__input" type="radio" data-response="{{ $response+1 }}" value="Inférieur à 52 886€" data-toggle="message">
                            <span class="option-btn__text">Inférieur à 52 886€</span>
                        </label>
                        <label class="option-btn" role="button">
                            <input class="option-btn__input" type="radio" data-response="{{ $response+1 }}" value="Entre 52 886€ et 64 380€" data-toggle="message">
                            <span class="option-btn__text">Entre 52 886€ et 64 380€</span>
                        </label>
                        <label class="option-btn" role="button">
                            <input class="option-btn__input" type="radio" data-response="{{ $response+1 }}" value="Entre 64 380€ et 90 496€" data-toggle="message">
                            <span class="option-btn__text">Entre 64 380€ et 90 496€</span>
                        </label>
                        <label class="option-btn" role="button">
                            <input class="option-btn__input" type="radio" data-response="{{ $response+1 }}" value="Superieur à 90 496€" data-toggle="message">
                            <span class="option-btn__text">Superieur à 90 496€</span>
                        </label>
                    @endif
                    @break
                @case(6)
                    @if ($all_value['1'] == 'Non')
                        <label class="option-btn" role="button">
                            <input class="option-btn__input" type="radio" data-response="{{ $response+1 }}" value="Inférieur à 42 981€" data-toggle="message">
                            <span class="option-btn__text">Inférieur à 42 981€</span>
                        </label>
                        <label class="option-btn" role="button">
                            <input class="option-btn__input" type="radio" data-response="{{ $response+1 }}" value="Entre 42 981€ et 55 095€" data-toggle="message">
                            <span class="option-btn__text">Entre 42 981€ et 55 095€</span>
                        </label>
                        <label class="option-btn" role="button">
                            <input class="option-btn__input" type="radio" data-response="{{ $response+1 }}" value="Entre 55 095€ et 77 825€" data-toggle="message">
                            <span class="option-btn__text">Entre 55 095€ et 77 825€</span>
                        </label>
                        <label class="option-btn" role="button">
                            <input class="option-btn__input" type="radio" data-response="{{ $response+1 }}" value="Superieur à 77 825€" data-toggle="message">
                            <span class="option-btn__text">Superieur à 77 825€</span>
                        </label>
                    @else
                        <label class="option-btn" role="button">
                            <input class="option-btn__input" type="radio" data-response="{{ $response+1 }}" value="Inférieur à 59 536€" data-toggle="message">
                            <span class="option-btn__text">Inférieur à 59 536€</span>
                        </label>
                        <label class="option-btn" role="button">
                            <input class="option-btn__input" type="radio" data-response="{{ $response+1 }}" value="Entre 59 536€ et 72 477€" data-toggle="message">
                            <span class="option-btn__text">Entre 59 536€ et 72 477€</span>
                        </label>
                        <label class="option-btn" role="button">
                            <input class="option-btn__input" type="radio" data-response="{{ $response+1 }}" value="Entre 72 477€ et 101 951€" data-toggle="message">
                            <span class="option-btn__text">Entre 72 477€ et 101 951€</span>
                        </label>
                        <label class="option-btn" role="button">
                            <input class="option-btn__input" type="radio" data-response="{{ $response+1 }}" value="Superieur à 101 951€" data-toggle="message">
                            <span class="option-btn__text">Superieur à 101 951€</span>
                        </label>
                    @endif
                    @break
                @case(7)
                    @if ($all_value['1'] == 'Non')
                        <label class="option-btn" role="button">
                            <input class="option-btn__input" type="radio" data-response="{{ $response+1 }}" value="Inférieur à 47 794€" data-toggle="message">
                            <span class="option-btn__text">Inférieur à 47 794€</span>
                        </label>
                        <label class="option-btn" role="button">
                            <input class="option-btn__input" type="radio" data-response="{{ $response+1 }}" value="Entre 47 794€ et 61 260€" data-toggle="message">
                            <span class="option-btn__text">Entre 47 794€ et 61 260€</span>
                        </label>
                        <label class="option-btn" role="button">
                            <input class="option-btn__input" type="radio" data-response="{{ $response+1 }}" value="Entre 61 260€ et 86 569€" data-toggle="message">
                            <span class="option-btn__text">Entre 61 260€ et 86 569€</span>
                        </label>
                        <label class="option-btn" role="button">
                            <input class="option-btn__input" type="radio" data-response="{{ $response+1 }}" value="Superieur à 86 569€" data-toggle="message">
                            <span class="option-btn__text">Superieur à 86 569€</span>
                        </label>
                    @else
                        <label class="option-btn" role="button">
                            <input class="option-btn__input" type="radio" data-response="{{ $response+1 }}" value="Inférieur à 66 186€" data-toggle="message">
                            <span class="option-btn__text">Inférieur à 66 186€</span>
                        </label>
                        <label class="option-btn" role="button">
                            <input class="option-btn__input" type="radio" data-response="{{ $response+1 }}" value="Entre 66 186€ et 80 574€" data-toggle="message">
                            <span class="option-btn__text">Entre 66 186€ et 80 574€</span>
                        </label>
                        <label class="option-btn" role="button">
                            <input class="option-btn__input" type="radio" data-response="{{ $response+1 }}" value="Entre 80 574€ et 113 406€" data-toggle="message">
                            <span class="option-btn__text">Entre 80 574€ et 113 406€</span>
                        </label>
                        <label class="option-btn" role="button">
                            <input class="option-btn__input" type="radio" data-response="{{ $response+1 }}" value="Superieur à 113 406€" data-toggle="message">
                            <span class="option-btn__text">Superieur à 113 406€</span>
                        </label>
                    @endif
                    @break
                @default
            @endswitch
        </div>
    </div>
@elseif($response == '4')
    <div class="chat__card chat__card--client">
        <div class="chat__message-wrapper" style="--index: 0">
            <div class="chat__message">{{ $value }}</div>
        </div>
    </div>
    <div class="chat__card chat__card--agent">
        <div class="chat__message-wrapper" style="--index: 1">
            <div class="chat__message">Pour quel projet souhaitez vous estimez votre aide ?</div>
        </div>
        <div class="chat__message-wrapper" style="--index: 2">
            <label class="option-btn" role="button">
                <input class="option-btn__input" type="radio"  data-response="{{ $response+1 }}" value="Chaudière à Granulés" data-toggle="message">
                <span class="option-btn__text">Chaudière à Granulés</span>
            </label>
            {{-- <label class="option-btn" role="button">
                <input class="option-btn__input" type="radio"  data-response="{{ $response+1 }}" value="Chaudière à Granulés + Chauffe Eau Solaire & Thermodynamique" data-toggle="message">
                <span class="option-btn__text">Chaudière à Granulés + Chauffe Eau Solaire & Thermodynamique</span>
            </label>
            <label class="option-btn" role="button">
                <input class="option-btn__input" type="radio"  data-response="{{ $response+1 }}" value="Chaudière à Granulés + Chauffe Eau Solaire & Thermodynamique + Poêle à Granulés" data-toggle="message">
                <span class="option-btn__text">Chaudière à Granulés + Chauffe Eau Solaire & Thermodynamique + Poêle à Granulés</span>
            </label> --}}
            <label class="option-btn" role="button">
                <input class="option-btn__input" type="radio"  data-response="{{ $response+1 }}" value="Pompe a chaleur" data-toggle="message">
                <span class="option-btn__text">Pompe a chaleur</span>
            </label>
            {{-- <label class="option-btn" role="button">
                <input class="option-btn__input" type="radio"  data-response="{{ $response+1 }}" value="Pompe a chaleur + Chauffe Eau Solaire & Thermodynamique" data-toggle="message">
                <span class="option-btn__text">Pompe a chaleur + Chauffe Eau Solaire & Thermodynamique</span>
            </label>
            <label class="option-btn" role="button">
                <input class="option-btn__input" type="radio"  data-response="{{ $response+1 }}" value="Pompe a chaleur + Chauffe Eau Solaire & Thermodynamique + Poêle à Granulés" data-toggle="message">
                <span class="option-btn__text">Pompe a chaleur + Chauffe Eau Solaire & Thermodynamique + Poêle à Granulés</span>
            </label> --}}
            {{-- <label class="option-btn" role="button">
                <input class="option-btn__input" type="radio"  data-response="{{ $response+1 }}" value="Système Solaire Combiné" data-toggle="message">
                <span class="option-btn__text">Système Solaire Combiné</span>
            </label>
            <label class="option-btn" role="button">
                <input class="option-btn__input" type="radio"  data-response="{{ $response+1 }}" value="Système Solaire Combiné + Chauffe Eau Solaire & Thermodynamique" data-toggle="message">
                <span class="option-btn__text">Système Solaire Combiné + Chauffe Eau Solaire & Thermodynamique</span>
            </label>
            <label class="option-btn" role="button">
                <input class="option-btn__input" type="radio"  data-response="{{ $response+1 }}" value="Sytème Solaire Combiné + Chauffe Eau Solaire & Thermodynamique + Poêle à Granulés" data-toggle="message">
                <span class="option-btn__text">Sytème Solaire Combiné + Chauffe Eau Solaire & Thermodynamique + Poêle à Granulés</span>
            </label> --}}
            <label class="option-btn" role="button">
                <input class="option-btn__input" type="radio"  data-response="{{ $response+1 }}" value="Système Solaire Combiné + Pompe à chaleur" data-toggle="message">
                <span class="option-btn__text">Système Solaire Combiné + Pompe à chaleur</span>
            </label>
            {{-- <label class="option-btn" role="button">
                <input class="option-btn__input" type="radio"  data-response="{{ $response+1 }}" value="Système Solaire Combiné + Pompe à chaleur + Poêle à Granulés" data-toggle="message">
                <span class="option-btn__text">Système Solaire Combiné + Pompe à chaleur + Poêle à Granulés</span>
            </label> --}}
        </div>
    </div>
@else 
    @if ($value == 'Chaudière à Granulés' || $value ==  'Pompe a chaleur')
        <div class="chat__card chat__card--client">
            <div class="chat__message-wrapper" style="--index: 0">
                <div class="chat__message">{{ $value }}</div>
            </div>
        </div>
        <div class="chat__card chat__card--agent">
            <div class="chat__message-wrapper" style="--index: 1">
                <div class="chat__message">Souhaitez-vous ajouter un Chauffe-Eau Thermodynamique & Solaire à votre projet ?
                </div>
            </div>
            <div class="chat__message-wrapper" style="--index: 2">
                <label class="option-btn" role="button">
                    <input class="option-btn__input" type="radio" data-response="6" value="Oui" data-toggle="message">
                    <span class="option-btn__text">Oui</span>
                </label>
                <label class="option-btn" role="button">
                    <input class="option-btn__input" type="radio" data-response="6" value="Non" data-toggle="message">
                    <span class="option-btn__text">Non</span>
                </label>
            </div>
        </div>
    @else
        @php
            $selected_project = $value;
            $MaPrimeRenov = '';
            $price = ''; 
        @endphp
        <div class="chat__card chat__card--client">
            <div class="chat__message-wrapper" style="--index: 0">
                @if ($value == 'Oui')
                    @if ($all_value['5'] == 'Chaudière à Granulés')
                        <div class="chat__message">{{ $value }}</div>
                        @php
                            $selected_project = 'Chaudière à Granulés + Chauffe-Eau Thermodynamique & Solaire';
                        @endphp
                    @else
                        <div class="chat__message">{{ $value }}</div>
                        @php
                            $selected_project = 'Pompe à Chaleur + Chauffe-Eau Thermodynamique & Solaire';
                        @endphp
                    @endif
                @elseif ($value == 'Non')
                    <div class="chat__message">{{ $value }}</div>
                    @php
                        $selected_project = $all_value['5'];
                    @endphp
                @else
                    <div class="chat__message">{{ $value }}</div>
                @endif
            </div>
        </div>
        <div class="chat__card chat__card--agent">
            <div class="chat__message-wrapper" style="--index: 1">
                <div class="chat__message">Voici l'estimation des aides publiques auxquelles vous avez droit :</div>
            </div>
            @if  (
            $all_value['4'] == 'Inférieur à 16 229€' 
            || $all_value['4'] == 'Inférieur à 23 734€' 
            || $all_value['4'] == 'Inférieur à 28 545€' 
            || $all_value['4'] == 'Inférieur à 33 346€' 
            || $all_value['4'] == 'Inférieur à 38 168€' 
            || $all_value['4'] == 'Inférieur à 42 981€' 
            || $all_value['4'] == 'Inférieur à 47 794€' 
            || $all_value['4'] == 'Inférieur à 22 461€' 
            || $all_value['4'] == 'Inférieur à 32 967€' 
            || $all_value['4'] == 'Inférieur à 39 591€' 
            || $all_value['4'] == 'Inférieur à 46 226€' 
            || $all_value['4'] == 'Inférieur à 52 886€' 
            || $all_value['4'] == 'Inférieur à 59 536€' 
            || $all_value['4'] == 'Inférieur à 66 186€')
                @switch($selected_project)
                    @case('Chaudière à Granulés')
                        @php 
                            $MaPrimeRenov = 'Bleu';
                            $price = '14,000€';
                        @endphp
                        @break
                    @case('Chaudière à Granulés + Chauffe-Eau Thermodynamique & Solaire')
                        @php 
                            $MaPrimeRenov = 'Bleu';
                            $price = '19,200€';
                        @endphp
                        @break 
                    @case('Pompe a chaleur')
                        @php 
                            $MaPrimeRenov = 'Bleu';
                            $price = '8,000€';
                        @endphp
                        @break
                    @case('Pompe à Chaleur + Chauffe-Eau Thermodynamique & Solaire')
                        @php 
                            $MaPrimeRenov = 'Bleu';
                            $price = '13,200€';
                        @endphp
                        @break 
                    @case('Système Solaire Combiné + Pompe à chaleur')
                        @php 
                            $MaPrimeRenov = 'Bleu';
                            $price = '18,000€';
                        @endphp
                        @break 
                    @default
                @endswitch
            @elseif ($all_value['4'] == 'Entre 16 229 € et 20 805€'
            || $all_value['4'] == 'Entre 23 734 € et 30 427€'
            || $all_value['4'] == 'Entre 28 545 € et 36 591€'
            || $all_value['4'] == 'Entre 33 346 € et 42 478€'
            || $all_value['4'] == 'Entre 38 168€ et 48 930€'
            || $all_value['4'] == 'Entre 42 981€ et 55 095€'
            || $all_value['4'] == 'Entre 47 794€ et 61 260€'
            || $all_value['4'] == 'Entre 22 461 € et 27 343€'
            || $all_value['4'] == 'Entre 32 967€ et 40 130€'
            || $all_value['4'] == 'Entre 39 591€ et 48 197€'
            || $all_value['4'] == 'Entre 46 226€  et 56 277€'
            || $all_value['4'] == 'Entre 52 886€ et 64 380€'
            || $all_value['4'] == 'Entre 59 536€ et 72 477€'
            || $all_value['4'] == 'Entre 66 186€ et 80 574€') 
                @switch($selected_project)
                    @case('Chaudière à Granulés') 
                        @php 
                            $MaPrimeRenov = 'Jaune';
                            $price = '12,000€';
                        @endphp
                        @break
                    @case('Chaudière à Granulés + Chauffe-Eau Thermodynamique & Solaire') 
                        @php 
                            $MaPrimeRenov = 'Jaune';
                            $price = '15,800€';
                        @endphp
                        @break 
                    @case('Pompe a chaleur') 
                        @php 
                            $MaPrimeRenov = 'Jaune';
                            $price = '7,000€';
                        @endphp
                        @break
                    @case('Pompe à Chaleur + Chauffe-Eau Thermodynamique & Solaire') 
                        @php 
                            $MaPrimeRenov = 'Jaune';
                            $price = '11,800€';
                        @endphp
                        @break 
                    @case('Système Solaire Combiné + Pompe à chaleur') 
                        @php 
                            $MaPrimeRenov = 'Jaune';
                            $price = '15,000€';
                        @endphp
                        @break  
                    @default
                @endswitch 
            @elseif ($all_value['4'] == 'Entre 20 805€ et 29 148€'
            || $all_value['4'] == 'Entre 30 427€ et 42 848€'
            || $all_value['4'] == 'Entre 36 591€ et 51 592€'
            || $all_value['4'] == 'Entre 42 478€ et 60 336€'
            || $all_value['4'] == 'Entre 48 930€ et 69 081€'
            || $all_value['4'] == 'Entre 55 095€ et 77 825€'
            || $all_value['4'] == 'Entre 61 260€ et 86 569€'
            || $all_value['4'] == 'Entre 27 343€ et 38 184€'
            || $all_value['4'] == 'Entre 40 130€ et 56 130€'
            || $all_value['4'] == 'Entre 48 197€ et 67 585€'
            || $all_value['4'] == 'Entre 56 277€ et 79 041€'
            || $all_value['4'] == 'Entre 64 380€ et 90 496€'
            || $all_value['4'] == 'Entre 72 477€ et 101 951€'
            || $all_value['4'] == 'Entre 80 574€ et 113 406€')
                @switch($selected_project)
                    @case('Chaudière à Granulés')
                        @php 
                            $MaPrimeRenov = 'Violet';
                            $price = '6,500€';
                        @endphp
                        @break
                    @case('Chaudière à Granulés + Chauffe-Eau Thermodynamique & Solaire')
                        @php 
                            $MaPrimeRenov = 'Violet';
                            $price = '8,900€';
                        @endphp
                        @break 
                    @case('Pompe a chaleur')
                        @php 
                            $MaPrimeRenov = 'Violet';
                            $price = '4,500€';
                        @endphp
                        @break
                    @case('Pompe à Chaleur + Chauffe-Eau Thermodynamique & Solaire')
                        @php 
                            $MaPrimeRenov = 'Violet';
                            $price = '6,900€';
                        @endphp
                        @break 
                    @case('Système Solaire Combiné + Pompe à chaleur')
                        @php 
                            $MaPrimeRenov = 'Violet';
                            $price = '8,500€';
                        @endphp
                        @break 
                    @default
                @endswitch 
            @elseif ($all_value['4'] == 'Supérieur à 29 148€'
            || $all_value['4'] == 'Supérieur à 42 848€'
            || $all_value['4'] == 'Supérieur à 51 592€'
            || $all_value['4'] == 'Superieur à 60 336€'
            || $all_value['4'] == 'Superieur à 69 081€'
            || $all_value['4'] == 'Superieur à 77 825€'
            || $all_value['4'] == 'Superieur à 86 569€'
            || $all_value['4'] == 'Supérieur à 38 184€'
            || $all_value['4'] == 'Supérieur à 56 130€'
            || $all_value['4'] == 'Supérieur à 67 585€'
            || $all_value['4'] == 'Superieur à 79 041€'
            || $all_value['4'] == 'Superieur à 90 496€'
            || $all_value['4'] == 'Superieur à 101 951€'
            || $all_value['4'] == 'Superieur à 113 406€')
                @switch($selected_project)
                    @case('Chaudière à Granulés') 
                        @php 
                            $MaPrimeRenov = 'Rose';
                            $price = '2,500€';
                        @endphp
                        @break
                    @case('Chaudière à Granulés + Chauffe-Eau Thermodynamique & Solaire') 
                        @php 
                            $MaPrimeRenov = 'Rose';
                            $price = '2,600€';
                        @endphp
                        @break 
                    @case('Pompe a chaleur') 
                        @php 
                            $MaPrimeRenov = 'Rose';
                            $price = '2,500€';
                        @endphp
                        @break
                    @case('Pompe à Chaleur + Chauffe-Eau Thermodynamique & Solaire') 
                        @php 
                            $MaPrimeRenov = 'Rose';
                            $price = '2,700€';
                        @endphp
                        @break 
                    @case('Système Solaire Combiné + Pompe à chaleur') 
                        @php 
                            $MaPrimeRenov = 'Rose';
                            $price = '2,500€';
                        @endphp
                        @break 
                    @default
                @endswitch 
            @endif 
            <div class="chat__message-wrapper" style="--index: 2">
                <div class="chat__message">D'après les informations que vous avez fournies, votre profil MaPrimeRénov serait : {{ $MaPrimeRenov }}</div>
            </div>
            <div class="chat__message-wrapper" style="--index: 3">
                <div class="chat__message">Avec votre  profil, les aides financières pour votre projet s’élève à: {{ $price }}</div>
            </div>
            <div class="chat__message-wrapper" style="--index: 4">
                <div class="chat__message">Vous souhaitez contacter notre expert et financer votre projet dès maintenant ? <br><br> Renseigner les informations ci dessous et l’un de nos experts énergétique vous contactera pour vous aider à bénéficier des aides pour votre projet de rénovation énergétique</div>
            </div>
            <div class="chat__message-wrapper" style="--index: 5">
                <div class="chat__message flex-grow-1">
                    <p>Veuillez remplir le formulaire et entrer vos détails ci-dessous.</p>
                    <form action="javascript:void(0);" class="form" data-toggle="form" id="chatBotSubmitForm">
                        <div class="form-row">
                            <div class="form-col">
                                <label class="form-lable">Prenom*</label>
                                <input type="text" class="form-control" id="botFirstName" placeholder=" " required>
                                <div class="form-error">
                                    <small class="form-error__after">Champs requis</small>
                                </div>
                            </div>
                            <div class="form-col">
                                <label class="form-lable">Nom*</label>
                                <input type="text" class="form-control" id="botLastName" placeholder=" " required>
                                <div class="form-error">
                                    <small class="form-error__after">Champs requis</small>
                                </div>
                            </div>
                            <div class="form-col">
                                <label class="form-lable">Téléphone*</label>
                                <input type="number" class="form-control" id="botTelephone" placeholder=" " required>
                                <div class="form-error">
                                    {{-- <small class="form-error__before">Votre e-mail et votre téléphone seront vos identifiants de téléchargement.</small> --}}
                                    <small class="form-error__after">Champs requis</small>
                                </div>
                            </div>
                            <div class="form-col">
                                <label class="form-lable">E-mail*</label>
                                <input type="email" class="form-control" id="botEmail" placeholder=" " required>
                                <div class="form-error">
                                    <small class="form-error__after">Champs requis</small>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="text-right">
                            <button type="submit" class="form-btn">Soumettre</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
@endif
