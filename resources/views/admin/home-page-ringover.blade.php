@forelse(getCalls() as $calls)
    <tr>
        <td class="align-middle">
            <p class="ringover-call-last_state">
                @if ($calls['last_state'] == 'ANSWERED')
                    A RÉPONDU
                @elseif ($calls['last_state'] == 'MISSED')
                    MANQUÉE
                @elseif ($calls['last_state'] == 'FAILED')
                    ÉCHOUÉ
                @elseif ($calls['last_state'] == 'VOICEMAIL')
                    MESSAGERIE VOCALE
                @else
                    {{ $calls['last_state'] }}
                @endif
        </p>
        </td>
        <td>
            @if ($calls['user'] && $calls['user']['picture'])
                <div class="ringover-call-user">
                    {{-- <div class="ringover-call-user__avatar">
                        <img src="{{ $calls['user']['picture'] }}" alt="user" width="50" height="50" class="ringover-call-user__avatar__image" loading="lazy">
                    </div> --}}
                    <div class="ringover-call-user__details">
                        <p class="ringover-call-user__details__name">{{ $calls['user']['firstname'] }} {{ $calls['user']['lastname'] }}</p>
                        <span class="ringover-call-user__details__number">{{ $calls['to_number'] }}</span>
                    </div>
                </div>
            @else
                <div class="ringover-call-user">
                    {{-- <div class="ringover-call-user__avatar">
                        <img src="https://ui-avatars.com/api/?name=U&background=DDDDDD&size=60" alt="user" width="50" height="50" class="ringover-call-user__avatar__image" loading="lazy">
                    </div> --}}
                    <div class="ringover-call-user__details">
                        <p class="ringover-call-user__details__name">{{ __('Unknown') }}</p>
                        <span class="ringover-call-user__details__number">{{ $calls['to_number'] }}</span>
                    </div>
                </div>
            @endif
        </td>
        <td class="align-middle">
            @if ($calls['ivr'] && $calls['ivr']['name'])
                <span class="badge--custom" style="color: #{{ $calls['ivr']['color'] }}">{{ $calls['ivr']['name'] }}</span>
            @endif
        </td>
        <td class="align-middle">
            @if ($calls['last_state'] == 'ANSWERED')
            <p class="ringover-call-status ringover-call-status--answered">
                <svg class="ringover-call-status__icon" width="1em" height="1em" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M1.99187 10.009C-0.453221 7.56394 -0.668368 3.98806 1.46344 1.26612L1.60416 1.0918L3.88653 3.37416L3.81272 3.47881C2.77341 5.00185 3.14654 6.66814 4.23964 7.76123C5.32024 8.84183 6.96098 9.21885 8.46976 8.22329L8.62674 8.11436L10.9091 10.3967L10.6996 10.5647L10.6634 10.5927C7.95055 12.6654 4.41563 12.4328 1.99187 10.009Z" fill="#28C76F"/>
                    <path d="M6.68359 5.33637L11.3071 0.712891" stroke="#28C76F" stroke-width="1.09091"/>
                    <path d="M10.5403 5.33617H6.68652V1.48242" stroke="#28C76F" stroke-width="1.09091"/>
                </svg>
                <span class="ringover-call-status__number">{{ $calls['from_number'] }}</span>
            </p>
            @elseif ($calls['last_state'] == 'VOICEMAIL')
            <p class="ringover-call-status ringover-call-status--voicemail">
                <svg class="ringover-call-status__icon" width="1em" height="1em" viewBox="0 0 29 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M26.9278 6.94286C26.9302 6.29302 26.8037 5.64915 26.5558 5.04848C26.3078 4.44781 25.9432 3.90225 25.4831 3.44335C25.023 2.98445 24.4765 2.6213 23.8751 2.37491C23.2738 2.12851 22.6296 2.00376 21.9798 2.00786C21.3299 2.00468 20.6858 2.13038 20.0847 2.37769C19.4837 2.62499 18.9377 2.989 18.4782 3.44866C18.0187 3.90832 17.6549 4.45452 17.4079 5.05565C17.1608 5.65679 17.0354 6.30094 17.0388 6.95086C17.0332 7.60488 17.1581 8.25346 17.4061 8.85862C17.6542 9.46379 18.0205 10.0134 18.4836 10.4753C18.9467 10.9371 19.4973 11.302 20.1031 11.5485C20.7089 11.795 21.3578 11.9182 22.0118 11.9109C22.6617 11.9108 23.3052 11.7818 23.905 11.5315C24.5048 11.2811 25.049 10.9144 25.5061 10.4524C25.9633 9.99038 26.3243 9.44234 26.5683 8.83995C26.8124 8.23756 26.9345 7.59277 26.9278 6.94286M6.92379 11.9129C8.23653 11.9169 9.49735 11.4005 10.4302 10.4769C11.363 9.55322 11.8918 8.29757 11.9008 6.98486C11.9168 4.26086 9.70979 2.02986 6.97479 2.00786C6.32491 2.0002 5.67993 2.12115 5.07697 2.36374C4.47401 2.60632 3.92498 2.96576 3.46148 3.42136C2.99798 3.87696 2.62915 4.41974 2.37624 5.01844C2.12332 5.61713 1.99131 6.25994 1.9878 6.90986C1.9698 9.68886 4.15379 11.9009 6.92379 11.9109M11.8688 11.8859H17.0348C16.7988 11.5879 16.6038 11.3539 16.4218 11.1089C14.6758 8.76586 14.5798 5.61986 16.1758 3.15186C17.7348 0.742862 20.7098 -0.465138 23.5138 0.173862C26.3278 0.816862 28.4788 3.16586 28.8638 6.01886C29.1039 7.77472 28.663 9.55591 27.6316 10.997C26.6001 12.4381 25.0563 13.4299 23.3168 13.7689C22.8183 13.8664 22.3117 13.9166 21.8038 13.9189C16.8448 13.9289 11.8858 13.9359 6.9268 13.9199C3.50979 13.9099 1.0038 11.5079 0.264795 8.87986C-0.815205 5.03386 1.50979 1.07086 5.39479 0.175862C9.22079 -0.705138 13.0628 1.81486 13.7638 5.70086C14.1538 7.86286 13.5988 9.79686 12.2038 11.4899L11.8688 11.8859" fill="url(#call_voivemail_gradient)"/>
                    <defs>
                        <linearGradient id="call_voivemail_gradient" x1="-2.73322e-08" y1="5.35012" x2="24.7467" y2="17.264" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#FFC54F"/>
                            <stop offset="1" stop-color="#FF9B4A"/>
                        </linearGradient>
                    </defs>
                </svg>
                <span class="ringover-call-status__number">{{ $calls['from_number'] }}</span>
            </p>
            @elseif ($calls['last_state'] == 'CANCELLED')
            <p class="ringover-call-status ringover-call-status--cancelled">
                <svg class="ringover-call-status__icon" width="1em" height="1em" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M3.65176 18.0416C-0.830904 13.5589 -1.22534 7.00318 2.68297 2.01295L2.94097 1.69336L7.12531 5.8777L6.98999 6.06955C5.08459 8.86179 5.76866 11.9167 7.77267 13.9207C9.75377 15.9018 12.7618 16.593 15.5279 14.7677L15.8157 14.5681L20 18.7524L19.616 19.0602L19.5495 19.1117C14.576 22.9115 8.09533 22.4852 3.65176 18.0416V18.0416Z" fill="currentColor"/>
                    <path d="M12.2539 9.47637L20.7303 1" stroke="currentColor" stroke-width="2"/>
                    <path d="M20.7305 9.47637L12.2541 1" stroke="currentColor" stroke-width="2"/>
                </svg>
                <span class="ringover-call-status__number">{{ $calls['from_number'] }}</span>
            </p>
            @elseif ($calls['last_state'] == 'FAILED')
            <p class="ringover-call-status ringover-call-status--failed">
                <svg class="ringover-call-status__icon" width="1em" height="1em" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M3.65176 18.0416C-0.830904 13.5589 -1.22534 7.00318 2.68297 2.01295L2.94097 1.69336L7.12531 5.8777L6.98999 6.06955C5.08459 8.86179 5.76866 11.9167 7.77267 13.9207C9.75377 15.9018 12.7618 16.593 15.5279 14.7677L15.8157 14.5681L20 18.7524L19.616 19.0602L19.5495 19.1117C14.576 22.9115 8.09533 22.4852 3.65176 18.0416V18.0416Z" fill="currentColor"/>
                    <path d="M12.2539 9.47637L20.7303 1" stroke="currentColor" stroke-width="2"/>
                    <path d="M20.7305 9.47637L12.2541 1" stroke="currentColor" stroke-width="2"/>
                </svg>
                <span class="ringover-call-status__number">{{ $calls['from_number'] }}</span>
            </p>
            @elseif ($calls['last_state'] == 'MISSED')
            <p class="ringover-call-status ringover-call-status--missed">
                <svg class="ringover-call-status__icon" width="1em" height="1em" viewBox="0 0 24 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10.6992 6.85648V1H16.4284" stroke="#F04E4F" stroke-width="2"/>
                    <path d="M10.6992 1L16.9201 7.38889L23.1701 1" stroke="#F04E4F" stroke-width="2"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M3.65176 17.3482C-0.830904 12.8656 -1.22534 6.30982 2.68297 1.31959L2.94097 1L7.12531 5.18434L6.98999 5.37619C5.08459 8.16843 5.76866 11.2233 7.77267 13.2273C9.69874 15.1534 12.5955 15.8602 15.2969 14.2207L15.582 14.0381L15.8157 13.8747L20 18.059L19.5495 18.4183C14.576 22.2182 8.09533 21.7918 3.65176 17.3482Z" fill="url(#call_missed_gradient)"/>
                    <defs>
                        <linearGradient id="call_missed_gradient" x1="20" y1="21" x2="0" y2="1" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#FF8888"/>
                            <stop offset="1" stop-color="#F05F5F"/>
                        </linearGradient>
                    </defs>
                </svg>
                <span class="ringover-call-status__number">{{ $calls['from_number'] }}</span>
            </p>
            @elseif ($calls['last_state'] == 'QUEUE_TIMEOUT')
            <p class="ringover-call-status ringover-call-status--timeout">
                <svg class="ringover-call-status__icon" width="1em" height="1em" viewBox="0 0 21 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M3.65176 19.3482C-0.830904 14.8656 -1.22534 8.30982 2.68297 3.31959L2.94097 3L7.12531 7.18434L6.98999 7.37619C5.08459 10.1684 5.76866 13.2233 7.77267 15.2273C9.69874 17.1534 12.5955 17.8602 15.2969 16.2207L15.582 16.0381L15.8157 15.8747L20 20.059L19.5495 20.4183C14.576 24.2182 8.09533 23.7918 3.65176 19.3482Z" fill="url(#call_timeout_gradient)"/>
                    <path d="M15.7788 3.65456V2.77522C15.7788 2.63584 15.6648 2.5218 15.5254 2.5218H14.641V1.93135C14.641 1.46507 15.0186 1.08495 15.4848 1.08495H15.6622C16.1285 1.08495 16.5061 1.46507 16.5061 1.93135C16.5061 2.2912 16.648 2.63077 16.9014 2.88672C17.1574 3.14266 17.4969 3.28204 17.8593 3.28204H17.9683C18.7133 3.28204 19.3215 2.67638 19.3215 1.93135C19.3215 1.79197 19.2075 1.67794 19.0681 1.67794C18.9287 1.67794 18.8147 1.79197 18.8147 1.93135C18.8147 2.39763 18.4346 2.77522 17.9683 2.77522H17.8593C17.6338 2.77522 17.4209 2.68652 17.2613 2.52687C17.1016 2.36722 17.0129 2.15689 17.0129 1.93135C17.0129 1.18632 16.4073 0.578125 15.6622 0.578125H15.4848C14.7398 0.578125 14.1341 1.18632 14.1341 1.93135V2.5218H13.2548C13.1154 2.5218 13.0014 2.63584 13.0014 2.77522V3.65456C10.67 4.27289 9 6.42943 9 8.85966C9 11.8322 11.4176 14.2498 14.3901 14.2498C17.3626 14.2498 19.7802 11.8322 19.7802 8.85966C19.7802 6.42943 18.1102 4.27289 15.7788 3.65456ZM14.3901 13.7429C11.6988 13.7429 9.50683 11.5534 9.50683 8.85966C9.50683 6.59668 11.1059 4.59472 13.3106 4.10057C13.4271 4.07269 13.5082 3.97133 13.5082 3.85222V3.02863H15.272V3.85222C15.272 3.97133 15.3531 4.07269 15.4696 4.10057C17.6743 4.59472 19.2734 6.59668 19.2734 8.85966C19.2734 11.5534 17.0813 13.7429 14.3901 13.7429V13.7429Z" fill="#F04E4F"/>
                    <path d="M14.3904 4.61133C12.0463 4.61133 10.1406 6.51953 10.1406 8.86106C10.1406 11.2051 12.0463 13.1108 14.3904 13.1108C16.7344 13.1108 18.6401 11.2051 18.6401 8.86106C18.6401 6.51953 16.7344 4.61133 14.3904 4.61133V4.61133ZM11.1061 9.05366H10.6779C10.574 9.05366 10.4878 8.9675 10.4878 8.8636C10.4878 8.7597 10.574 8.67354 10.6779 8.67354H11.1061C11.21 8.67354 11.2962 8.7597 11.2962 8.8636C11.2962 8.9675 11.21 9.05366 11.1061 9.05366ZM14.1978 5.14856C14.1978 5.04466 14.2839 4.9585 14.3878 4.9585C14.4943 4.9585 14.5779 5.04466 14.5779 5.14856V5.57683C14.5779 5.68073 14.4943 5.76689 14.3878 5.76689C14.2839 5.76689 14.1978 5.68073 14.1978 5.57683V5.14856ZM11.6282 6.10393C11.7042 6.02791 11.8233 6.02791 11.8968 6.10393L12.2009 6.40549C12.2744 6.47898 12.2744 6.60062 12.2009 6.67411C12.1629 6.71212 12.1147 6.72986 12.0666 6.72986C12.0159 6.72986 11.9677 6.71212 11.9323 6.67411L11.6282 6.37255C11.5547 6.29906 11.5547 6.17742 11.6282 6.10393V6.10393ZM12.2034 11.3192L11.9018 11.6233C11.8638 11.6587 11.8157 11.679 11.7675 11.679C11.7169 11.679 11.6687 11.6587 11.6332 11.6233C11.5572 11.5472 11.5572 11.4281 11.6332 11.3546L11.9348 11.0506C12.0083 10.9771 12.1299 10.9771 12.2034 11.0506C12.2769 11.1266 12.2769 11.2457 12.2034 11.3192V11.3192ZM14.583 12.5736C14.583 12.68 14.4968 12.7636 14.3929 12.7636C14.2865 12.7636 14.2028 12.68 14.2028 12.5736V12.1453C14.2028 12.0414 14.2865 11.9552 14.3929 11.9552C14.4968 11.9552 14.583 12.0414 14.583 12.1453V12.5736ZM14.3904 9.75815C14.2358 9.75815 14.0913 9.71507 13.9646 9.64664L13.0599 10.5488C13.0118 10.5995 12.9459 10.6223 12.8826 10.6223C12.8167 10.6223 12.7533 10.5995 12.7026 10.5488C12.6038 10.45 12.6038 10.2903 12.7026 10.1915L13.6048 9.2868C13.5364 9.16009 13.4933 9.01565 13.4933 8.86106C13.4933 8.4556 13.767 8.11603 14.1369 8.00453V6.50179C14.1369 6.36241 14.251 6.24838 14.3904 6.24838C14.5297 6.24838 14.6438 6.36241 14.6438 6.50179V8.00453C15.0138 8.11603 15.2874 8.4556 15.2874 8.86106C15.2874 9.35522 14.8845 9.75815 14.3904 9.75815V9.75815ZM16.5773 6.40296L16.8789 6.1014C16.9549 6.02537 17.074 6.02537 17.1475 6.1014C17.2235 6.17489 17.2235 6.29399 17.1475 6.37001L16.8459 6.67158C16.8079 6.70959 16.7598 6.72733 16.7116 6.72733C16.6635 6.72733 16.6153 6.70959 16.5773 6.67158C16.5038 6.59809 16.5038 6.47645 16.5773 6.40296ZM17.1526 11.6182C17.1146 11.6562 17.0664 11.6739 17.0183 11.6739C16.9676 11.6739 16.9194 11.6562 16.8839 11.6182L16.5798 11.3166C16.5064 11.2431 16.5064 11.1215 16.5798 11.048C16.6559 10.9745 16.775 10.9745 16.8485 11.048L17.1526 11.3496C17.2261 11.4256 17.2261 11.5447 17.1526 11.6182ZM18.1029 9.04859H17.6746C17.5707 9.04859 17.4845 8.96496 17.4845 8.85853C17.4845 8.75463 17.5707 8.66847 17.6746 8.66847H18.1029C18.2068 8.66847 18.2929 8.75463 18.2929 8.85853C18.2929 8.96496 18.2068 9.04859 18.1029 9.04859Z" fill="#F04E4F"/>
                    <path d="M14.7805 8.85901C14.7805 9.07441 14.6057 9.24926 14.3903 9.24926C14.1749 9.24926 14 9.07441 14 8.85901C14 8.64361 14.1749 8.46875 14.3903 8.46875C14.6057 8.46875 14.7805 8.64361 14.7805 8.85901Z" fill="#F04E4F"/>
                    <path d="M19.0659 1.2397C19.2061 1.2397 19.3193 1.12642 19.3193 0.986283V0.253413C19.3193 0.113276 19.2061 0 19.0659 0C18.9258 0 18.8125 0.113276 18.8125 0.253413V0.986537C18.8125 1.12642 18.9258 1.2397 19.0659 1.2397Z" fill="#F04E4F"/>
                    <path d="M18.2217 1.44136C18.2711 1.49077 18.336 1.51561 18.4009 1.51561C18.4657 1.51561 18.5306 1.49077 18.58 1.44136C18.6791 1.34227 18.6791 1.18212 18.58 1.08303L18.0615 0.564548C17.9625 0.465463 17.8023 0.465463 17.7032 0.564548C17.6041 0.663632 17.6041 0.823789 17.7032 0.922874L18.2217 1.44136Z" fill="#F04E4F"/>
                    <path d="M19.917 2.42002C19.8179 2.32093 19.6578 2.32093 19.5587 2.42002C19.4596 2.5191 19.4596 2.67926 19.5587 2.77834L20.0769 3.29657C20.1263 3.34599 20.1912 3.37082 20.2561 3.37082C20.321 3.37082 20.3858 3.34599 20.4352 3.29657C20.5343 3.19749 20.5343 3.03733 20.4352 2.93825L19.917 2.42002Z" fill="#F04E4F"/>
                    <path d="M20.7443 1.67773H20.0112C19.8711 1.67773 19.7578 1.79101 19.7578 1.93115C19.7578 2.07128 19.8711 2.18456 20.0112 2.18456H20.7443C20.8845 2.18456 20.9978 2.07128 20.9978 1.93115C20.9978 1.79101 20.8845 1.67773 20.7443 1.67773Z" fill="#F04E4F"/>
                    <path d="M19.7379 1.51561C19.8027 1.51561 19.8676 1.49077 19.917 1.44136L20.4352 0.922874C20.5343 0.823789 20.5343 0.663632 20.4352 0.564548C20.3362 0.465463 20.176 0.465463 20.0769 0.564548L19.5587 1.08303C19.4596 1.18212 19.4596 1.34227 19.5587 1.44136C19.6081 1.49077 19.673 1.51561 19.7379 1.51561Z" fill="#F04E4F"/>
                    <defs>
                        <linearGradient id="call_timeout_gradient" x1="20" y1="23" x2="0" y2="3" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#FF8888"/>
                            <stop offset="1" stop-color="#F05F5F"/>
                        </linearGradient>
                    </defs>
                </svg>
                <span class="ringover-call-status__number">{{ $calls['from_number'] }}</span>
            </p>
            @elseif ($calls['last_state'] == 'OUTGOING')
            <p class="ringover-call-status ringover-call-status--outgoing">
                <svg class="ringover-call-status__icon" width="1em" height="1em" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M20.7029 1.00195L12.5977 9.10616" stroke="#4990E2" stroke-width="2"/>
                    <path d="M13.8633 1H20.7054V7.84211" stroke="#4990E2" stroke-width="2"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M3.65176 18.3482C-0.830904 13.8656 -1.22534 7.30982 2.68297 2.31959L2.94097 2L7.12531 6.18434L6.98999 6.37619C5.08459 9.16843 5.76866 12.2233 7.77267 14.2273C9.75377 16.2084 12.7618 16.8996 15.5279 15.0744L15.8157 14.8747L20 19.059L19.616 19.3669L19.5495 19.4183C14.576 23.2182 8.09533 22.7918 3.65176 18.3482V18.3482Z" fill="url(#call_outgoing_gradient)"/>
                    <defs>
                        <linearGradient id="call_outgoing_gradient" x1="20" y1="22" x2="0" y2="2" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#72BBF1"/>
                            <stop offset="1" stop-color="#4B90E2"/>
                        </linearGradient>
                    </defs>
                </svg>
                <span class="ringover-call-status__number">{{ $calls['from_number'] }}</span>
            </p>
            @else
            <p class="ringover-call-status ringover-call-status--outgoing">
                <svg class="ringover-call-status__icon" width="1em" height="1em" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M20.7029 1.00195L12.5977 9.10616" stroke="#4990E2" stroke-width="2"/>
                    <path d="M13.8633 1H20.7054V7.84211" stroke="#4990E2" stroke-width="2"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M3.65176 18.3482C-0.830904 13.8656 -1.22534 7.30982 2.68297 2.31959L2.94097 2L7.12531 6.18434L6.98999 6.37619C5.08459 9.16843 5.76866 12.2233 7.77267 14.2273C9.75377 16.2084 12.7618 16.8996 15.5279 15.0744L15.8157 14.8747L20 19.059L19.616 19.3669L19.5495 19.4183C14.576 23.2182 8.09533 22.7918 3.65176 18.3482V18.3482Z" fill="url(#call_outgoing_gradient)"/>
                    <defs>
                        <linearGradient id="call_outgoing_gradient" x1="20" y1="22" x2="0" y2="2" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#72BBF1"/>
                            <stop offset="1" stop-color="#4B90E2"/>
                        </linearGradient>
                    </defs>
                </svg>
                <span class="ringover-call-status__number">{{ $calls['from_number'] }}</span>
            </p>
            @endif
        </td>
        <td>
            <div class="ringover-call-details">
                <p class="ringover-call-details__time">{{ \Carbon\Carbon::parse($calls['end_time'])->format('d M Y - h:i A') ?? 'Not answered' }}</p>
                <span class="ringover-call-details__duration ringover-call-details__duration--muted">
                    <i class="bi bi-hourglass-split"></i>
                    <span class="ringover-call-details__duration__text">{{ seconds2human($calls['incall_duration']) }}</span>
                </span>
                <span class="ringover-call-details__duration ringover-call-details__duration--highlight">
                    <svg width="1em" height="1em" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M3.65176 17.0416C-0.830904 12.5589 -1.22534 6.00318 2.68297 1.01295L2.94097 0.693359L7.12531 4.8777L6.98999 5.06955C5.08459 7.86179 5.76866 10.9167 7.77267 12.9207C9.75377 14.9018 12.7618 15.593 15.5279 13.7677L15.8157 13.5681L20 17.7524L19.616 18.0602L19.5495 18.1117C14.576 21.9115 8.09533 21.4852 3.65176 17.0416V17.0416Z" fill="url(#call_single_gradient)"/>
                        <defs>
                            <linearGradient id="call_single_gradient" x1="1.5308" y1="2.84983" x2="20" y2="20.6934" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#40E0CF"/>
                                <stop offset="1" stop-color="#36CDCF"/>
                            </linearGradient>
                        </defs>
                    </svg>
                    <span class="ringover-call-details__duration__text">{{ seconds2human($calls['total_duration']) }}</span>
                </span>
            </div>
        </td>
        <td class="align-middle">
            @if ($calls['record'])
                <div class="ringover-call-audio-wrapper">
                    <div class="ringover-call-btn-wrapper">
                        <button type="button" class="ringover-call-btn ringover-call-btn--record" data-audio-play>
                            <svg class="ringover-call-btn__icon" width="1em" height="1em" viewBox="0 0 20 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20 16.1401C20 15.5151 19.5221 15.0371 18.8971 15.0371C18.2721 15.0371 17.7941 15.5151 17.7941 16.1401C17.7941 20.4415 14.3015 23.9342 10 23.9342C5.69853 23.9342 2.20588 20.4415 2.20588 16.1401C2.20588 15.5151 1.72794 15.0371 1.10294 15.0371C0.477941 15.0371 0 15.5151 0 16.1401C0 21.2503 3.82353 25.5518 8.89706 26.1033V29.0445H4.88971C4.26471 29.0445 3.78677 29.5224 3.78677 30.1474C3.78677 30.7724 4.26471 31.2503 4.88971 31.2503H15.1103C15.7353 31.2503 16.2132 30.7724 16.2132 30.1474C16.2132 29.5224 15.7353 29.0445 15.1103 29.0445H11.1029V26.1033C16.1765 25.5518 20 21.2503 20 16.1401Z" fill="currentColor"/>
                                <path d="M9.99908 0C6.61673 0 3.85938 2.75735 3.85938 6.13971V16.1029C3.85938 19.5221 6.61673 22.2426 9.99908 22.2794C13.3814 22.2794 16.1388 19.5221 16.1388 16.1397V6.13971C16.1388 2.75735 13.3814 0 9.99908 0Z" fill="currentColor"/>
                            </svg>
                        </button>
                        <button type="button" class="ringover-call-btn ringover-call-btn--stop" data-audio-stop>
                            <svg class="ringover-call-btn__icon" width="1em" height="1em" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M5 3.5h6A1.5 1.5 0 0 1 12.5 5v6a1.5 1.5 0 0 1-1.5 1.5H5A1.5 1.5 0 0 1 3.5 11V5A1.5 1.5 0 0 1 5 3.5z"/>
                            </svg>
                        </button>
                    </div>
                    <audio class="ringover-call-audio" controls preload="none">
                        <source src="{{ $calls['record'] }}" type="audio/mpeg">
                    </audio>
                    <span class="ringover-call-duration"></span>
                </div>
            @endif
        </td>
        <td class="align-middle">
            @if ($calls['voicemail'])
                <div class="ringover-call-audio-wrapper">
                    <div class="ringover-call-btn-wrapper">
                        <button type="button" class="ringover-call-btn ringover-call-btn--voicemail" data-audio-play>
                            <svg class="ringover-call-btn__icon" width="1em" height="1em" viewBox="0 0 29 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12.0102 15.2345C9.2422 12.7528 8.6172 10.2712 8.4762 9.27689C8.4368 9.00197 8.54232 8.72626 8.7617 8.53096L11.0017 6.52358C11.3312 6.22834 11.3897 5.76822 11.1427 5.41409L7.5762 0.448991C7.30296 0.0568611 6.74192 -0.0846625 6.2807 0.122198L0.555198 2.53975C0.182227 2.7044 -0.0371492 3.05968 0.0051975 3.43047C0.305197 5.98565 1.5477 12.2669 8.4327 18.4401C15.3177 24.6133 22.3227 25.7268 25.1742 25.9958C25.5878 26.0337 25.984 25.8371 26.1677 25.5027L28.8642 20.3695C29.0941 19.9569 28.9373 19.4552 28.5017 19.2098L22.9637 16.0131C22.5689 15.7915 22.0557 15.8435 21.7262 16.1386L19.4872 18.1469C19.2694 18.3436 18.9618 18.4382 18.6552 18.4029C17.5462 18.2765 14.7782 17.7161 12.0102 15.2345V15.2345Z" fill="currentColor"/>
                                <path d="M21.5 0C17.358 0 14 2.60897 14 5.82759C14.0068 7.00854 14.4558 8.15324 15.275 9.07803L14.5 12.5517L18.432 11.1414C19.4102 11.482 20.4506 11.6562 21.5 11.6552C25.642 11.6552 29 9.04621 29 5.82759C29 2.60897 25.642 0 21.5 0ZM17.5 6.72414C16.9477 6.72414 16.5 6.32274 16.5 5.82759C16.5 5.33243 16.9477 4.93103 17.5 4.93103C18.0523 4.93103 18.5 5.33243 18.5 5.82759C18.5 6.32274 18.0523 6.72414 17.5 6.72414ZM21.5 6.72414C20.9477 6.72414 20.5 6.32274 20.5 5.82759C20.5 5.33243 20.9477 4.93103 21.5 4.93103C22.0523 4.93103 22.5 5.33243 22.5 5.82759C22.5 6.32274 22.0523 6.72414 21.5 6.72414ZM25.5 6.72414C24.9477 6.72414 24.5 6.32274 24.5 5.82759C24.5 5.33243 24.9477 4.93103 25.5 4.93103C26.0523 4.93103 26.5 5.33243 26.5 5.82759C26.5 6.32274 26.0523 6.72414 25.5 6.72414Z" fill="currentColor"/>
                            </svg>
                        </button>
                        <button type="button" class="ringover-call-btn ringover-call-btn--stop" data-audio-stop>
                            <svg class="ringover-call-btn__icon" width="1em" height="1em" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M5 3.5h6A1.5 1.5 0 0 1 12.5 5v6a1.5 1.5 0 0 1-1.5 1.5H5A1.5 1.5 0 0 1 3.5 11V5A1.5 1.5 0 0 1 5 3.5z"/>
                            </svg>
                        </button>
                    </div>
                    <audio class="ringover-call-audio" controls preload="none">
                        <source src="{{ $calls['voicemail'] }}" type="audio/mpeg">
                    </audio>
                </div>
            @endif
        </td>
    </tr>
@empty
    <tr>
        <td colspan="9000">
            <h2 class="text-center py-3">{{ __('No results found.') }}</h2>
        </td>
    </tr>
@endforelse