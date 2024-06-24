<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Invoive</title>
    <style>
		* {
			-webkit-print-color-adjust: exact !important;
			color-adjust: exact !important;
			margin: 0;
			padding: 0;
			outline: 0;
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
		}
		@page {
			size: A4;
			margin-left: 0;
			margin-right: 0;
			margin-top: 0;
			margin-bottom: 0;
			margin: 0;
			-webkit-print-color-adjust: exact !important;
			color-adjust: exact !important;
		}
		body {
			color: #212529;
			font-family: sans-serif;
			width: 100%;
			max-width: 79.37007874rem;
			margin: auto;
			-webkit-print-color-adjust: exact !important;
			color-adjust: exact !important;
		}
		.page {
			padding: 20px 40px 20px 40px;
		}

		tfoot,
		thead {
			background-color: #fff;
		}

		.border-bottom th,
		.border-bottom {
			border-bottom: 2px solid #000000;
		}

		.border-top th,
		.border-top {
			border-top: 2px solid #000000;
		}
    </style>
  </head>
  <body>
    <div class="page">
      <table
        cellpadding="0"
        cellspacing="0"
        style="width: 100%; font-family: sans-serif"
      >
        <thead>
          <tr class="top">
            <td colspan="2" style="width: 100%; padding: 40px 0">
              <table class="top" style="width: 100%">
                <tr>
                  <td class="title" align="left">
                    <img
                      style="max-height: 45px"
                      src="https://i.postimg.cc/nhZkQFbv/Screenshot-6.png"
                    />
                  </td>
				  
                  <td
                    align="right"
                    style="background-color: #ffffff; font-size: 7px"
                  >
                    <img
                      style="max-height: 35px"
                      src="https://i.postimg.cc/XqNmDQ1Z/package.png"
                      alt=""
                    />
                    <br />
                    N° QB/59003 <br />
                    VAL 21/09/2022
                  </td>
                  <td
                    align="right"
                    style="background-color: #ffffff; font-size: 7px"
                  >
                    <img
                      style="max-height: 35px"
                      src="https://i.postimg.cc/0jtFgDhV/package2.png"
                      alt=""
                    />
                    <br />
                    N° QPAC/59003 <br />
                    VAL 04/09/2022
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </thead>
        <tbody>
          <tr class="title">
            <td style="border-bottom: 2px solid #000000">
              <table style="width: 100%">
                <tr>
                  <td
                    style="
                      font-family: sans-serif;
                      font-size: 14px;
                      font-weight: 700;
                      padding-top: 25px;
                      color: #000000;
                      width: 50%;
                    "
                  >
                    DEVIS: DV{{ sprintf('%05d', $project->id) }}
                  </td>
                  <td
                    style="
                      font-family: sans-serif;
                      font-size: 14px;
                      font-weight: 700;
                      padding-top: 25px;
                      color: #000000;
                      width: 50%;
                    "
                  >
                  {{ ucwords($project->getClient->first_name) ." ". ucwords($project->getClient->last_name) }}
                  </td>
                </tr>
              </table>
            </td>
          </tr>
          <tr>
            <td>
              <table style="width: 100%">
                <tr>
                  <td
                    style="
                      width: 50%;
                      font-size: 11px;
                      vertical-align: baseline;
                      margin-top: 5px;
                    "
                  >
                    <p style="margin: 6px 0">
                      Numéro Client : <strong>{{ $project->getClient->id }}</strong> <br />
                      Date de devis : <strong>{{ \Carbon\Carbon::now()->format('d/m/Y') }}</strong> <br />
                      Date de visite préalable : <strong>{{ \Carbon\Carbon::parse($intervention->preview_date)->format('d/m/Y') }}</strong>
                      <br />
                      Adresse des travaux : <strong>{{ $project->getClient->address }}</strong>
                    </p>
                  </td>
                  <td style="width: 50%; font-size: 11px">
                    <p style="margin: 6px 0">
                        {{ $project->address }}
                        <br>
                      {{-- 27 GR GRANDE RUE <br />
                      55500 SAULVAUX <br />
                      55500 SAULVAUX <br /> --}}
                      <span style="margin-right: 55px">Zone : {{ $project->zone }}</span><br />
                      Précarité : {{ $project->precariousness }} <br />
                      Type de chauffage : {{ $project->heating_type }} <br /> 
                    </p>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
          <tr>
            <td>
              <table cellpadding="0" cellspacing="0" style="width: 100%">
                <tr
                  align="left"
                  class="border-bottom border-top"
                  style="font-size: 16px"
                >
                  <th style="width: 400px; font-size: 14px">
                    <p style="margin: 8px 0">Détail</p>
                  </th>
                  <th style="font-size: 14px">
                    <p style="margin: 8px 0">Quantité</p>
                  </th>
                  <th style="font-size: 14px">P.U TTC</th>
                  <th style="font-size: 14px">Total TTC</th>
                  <th style="font-size: 14px">TVA</th>
                </tr>
				@foreach ($project->getOperation as $operation)
					<tr>
						<td style="font-size: 10px">
							<p style="margin: 8px 0">
								{{ $operation->getBaremes->wording }} : {{ $operation->getBaremes->description }} <br /> 
                {{ $project->sidebar->getEnergyType->devis_text ?? '' }}
								{{-- BAR-TH-113 : Mise en place d’une chaudière biomasse
								individuelle à alimentation <br />
								automatique, associée à un silo de stockage des granulés
								d'un volume minimal de 225 <br />
								litres et un régulateur, en remplacement d'une chaudière
								Fioul hors condensation --}}
							</p>
						</td>
					</tr>
					<tr>
                  		<td style="font-size: 10px">
							<p style="margin: 8px 0">
								Marque <strong>{{ $operation->getProduct->getMarque->description ?? '' }}</strong> <br />
								Référence <strong>{{ $operation->getProduct->reference }}</strong> <br />
								<span style="color: red">( Efficacité saisonnière <strong>81.3</strong> %. selon le
								règlement (EU) 2015/1189 de la Commission du <br />
								28 avril 2015 <br />
								Puissance thermique nominale <strong>22 kW</strong> <br />
								Label flamme verte <strong>7*</strong> <br />
								Classe du régulateur <strong>CLASSE 6</strong>)</span>
							</p>
						</td>
					</tr>
					<tr>
						<td style="font-size: 10px">
							<p style="margin: 8px 0">
							<span style="color: red">- Dépose et remplacement d'une chaudière Fioul hors
								condensation</span>
							</p>
						</td>
					</tr>
					<tr>
						<td style="font-size: 10px">
							<p style="margin: 8px 0">
							- Kwh Cumac : <strong>{{ $operation->getBaremes->kwh_cumac }}</strong> <br />
							- Prime Coup de pouce CEE : <strong>{{ $operation->getBaremes->prime_coup }} €</strong>
							<br />
							<span style="color: red">
								Matériel(s) fourni(s) et mis en place par notre société
								<strong>NOVECOLOGY</strong>, SIRET <br />
								<strong>84994780900026</strong>, Certificat rge Numéro
								<strong>QB/59003</strong> attribué le
								<strong>21/09/2021</strong> valable <br />
								jusqu'au <strong>21/09/2022</strong>
							</span>
							</p>
						</td>
					</tr> 
					@foreach ($operation->getPrestation as $prestation)
						<tr>
							<p>
								<td>
								<p style="margin: 8px 0; font-size: 10px">
									<strong
									>{{ $prestation->title }}</strong
									>
								</p>
								</td>
								<td>
								<p style="margin: 8px 0; font-size: 10px">{{ $prestation->quantity }}</p>
								</td>
								<td>
								<p style="margin: 8px 0; font-size: 10px">{{ $prestation->pu_ttc }} €</p>
								</td>
								<td>
								<p style="margin: 8px 0; font-size: 10px">{{ $prestation->total_ttc }} €</p>
								</td>
								<td>
								<p style="margin: 8px 0; font-size: 10px">{{ $prestation->tax }} %</p>
								</td>
							</p>
						</tr>
						<tr>
							<td style="font-size: 10px">
								<p style="margin: 8px 0">
									{{ $prestation->description }}
								</p>
							</td>
						</tr>
					@endforeach
					{{-- <tr>
						<td>
							<p style="margin: 8px 0; font-size: 10px">
							<strong>Forfait fourniture d'un silo de stockage</strong>
							</p>
						</td>
						<td>
							<p style="margin: 8px 0; font-size: 10px">1,00</p>
						</td>
						<td>
							<p style="margin: 8px 0; font-size: 10px">1 299,00 €</p>
						</td>
						<td>
							<p style="margin: 8px 0; font-size: 10px">1 299,00 €</p>
						</td>
						<td><p style="margin: 8px 0; font-size: 10px">5,50 %</p></td>
					</tr>
					<tr>
						<td>
							<p style="font-size: 10px; margin: 8px 0">
							Fourniture d'un silo design de stockage HS France d'une
							capacité de 400 Litres - 260 <br />
							Kg
							</p>
						</td>
					</tr>
					<tr>
						<td>
							<p style="font-size: 10px; margin: 8px 0">
							Forfait main d'œuvre chaudière
							</p>
						</td>
						<td><p style="margin: 8px 0; font-size: 10px">1,00</p></td>
						<td>
							<p style="margin: 8px 0; font-size: 10px">2 770,50 €</p>
						</td>
						<td>
							<p style="margin: 8px 0; font-size: 10px">2 770,50 €</p>
						</td>
						<td><p style="margin: 8px 0; font-size: 10px">5,50 %</p></td>
					</tr>
					<tr>
						<td>
							<p style="margin: 8px 0; font-size: 10px">
							Frais de personnel et de déplacement <br />
							Pose, fournitures, accessoires complémentaires
							</p>
						</td>
					</tr>
					<tr>
						<td>
							<p style="margin: 8px 0; font-size: 10px">
							<strong>Main d'Œuvre Chaudière fumisterie</strong>
							</p>
						</td>
						<td><p style="margin: 8px 0; font-size: 10px">1,00</p></td>
						<td>
							<p style="margin: 8px 0; font-size: 10px">1 083,21 €</p>
						</td>
						<td>
							<p style="margin: 8px 0; font-size: 10px">1 083,21 €</p>
						</td>
						<td><p style="margin: 8px 0; font-size: 10px">5,50 %</p></td>
					</tr>
					<tr>
						<td>
							<p style="margin: 8px 0; font-size: 10px">
							Conduit d'évacuation, raccordement, extraction,
							accessoires
							</p>
						</td>
					</tr>
					<tr>
						<td>
							<p style="margin: 8px 0; font-size: 10px">
							<strong>Forfait main d'œuvre silo </strong>
							</p>
						</td>
						<td><p style="margin: 8px 0; font-size: 10px">1,00</p></td>
						<td>
							<p style="margin: 8px 0; font-size: 10px">1 571,95 €</p>
						</td>
						<td>
							<p style="margin: 8px 0; font-size: 10px">1 571,95 €</p>
						</td>
						<td><p style="margin: 8px 0; font-size: 10px">5,50 %</p></td>
					</tr>
					<tr>
						<td>
							<p style="margin: 8px 0; font-size: 10px">
							Installation d'un silo de stockage
							</p>
						</td>
					</tr>
					<tr>
						<td>
							<p style="margin: 8px 0; font-size: 10px">
							<strong>Gestion des déchets</strong>
							</p>
						</td>
						<td>
							<p style="margin: 8px 0; font-size: 10px">2,00 m³</p>
						</td>
						<td>
							<p style="margin: 8px 0; font-size: 10px">60,00 €</p>
						</td>
						<td>
							<p style="margin: 8px 0; font-size: 10px">120,00 €</p>
						</td>
						<td><p style="margin: 8px 0; font-size: 10px">5,50 %</p></td>
					</tr>
					<tr>
						<td>
							<p style="margin: 8px 0; font-size: 10px">
							Gestion, évacuation et traitements des déchets de chantier
							comprenant la main <br />
							d’œuvre liée à la dépose et au tri, le transport des
							déchets de chantier vers un ou
							</p>
						</td>
					</tr> --}}
				@endforeach
              </table>
            </td>
          </tr>
          {{-- <tr>
            <td style="border-bottom: 2px solid #000000">
              <table style="width: 100%">
                <tr>
                  <td style="width: 50%; font-size: 14px; color: #000000">
                    <strong>DEVIS: DV7835 du 02/06/2022</strong>
                  </td>
                  <td style="width: 50%; font-size: 14px; color: #000000">
                    <strong>M. CALAME PATRICK CHARLES LEON</strong>
                  </td>
                </tr>
              </table>
            </td>
          </tr> --}}
          {{-- <tr>
            <td align="left">
              <table cellpadding="0" cellspacing="0" style="width: 100%">
                <tr align="left" class="border-bottom">
                  <th style="width: 400px; font-size: 14px" align="left">
                    <p style="margin: 8px 0">Détail</p>
                  </th>
                  <th style="font-size: 14px" align="left">Quantité</th>
                  <th style="font-size: 14px">P.U TTC</th>
                  <th style="font-size: 14px">Total TTC</th>
                  <th style="font-size: 14px">TVA</th>
                </tr>
                <tr>
                  <td>
                    <p style="margin: 8px 0; font-size: 10px">
                      plusieurs points de collecte et les coûts de traitement.
                      <br />
                      NB : Les coûts et frais prévus au présent sont des
                      estimations, susceptibles d’être <br />
                      revues en fonction de la quantité réelle et de la nature
                      des déchets constatés en fin <br />
                      de chantier. <br />
                      Point de collecte : <br />
                      Cogetrad Industries <br />
                      84 Avenue du Château <br />
                      95310 Saint-Ouen-l'Aumône
                    </p>
                  </td>
                </tr>
                <tr>
                  <td>
                    <p style="margin: 8px 0; font-size: 10px">
                      BAR-TH-148 : Mise en place d’un chauffe-eau
                      thermodynamique à accumulation sur <br />
                      air extrait. <br />
                      Le COP du materiel installé est de :
                      <strong
                        >2,78 mesuré selon les conditions de la norme</strong
                      >
                      <br />
                      <strong>EN 16147</strong> <br />
                      Marque : <strong>THALEOS</strong> Réf :
                      <strong>PERFORMER 2 - 200L - THA 986 113</strong>
                    </p>
                  </td>
                </tr>
                <tr>
                  <td>
                    <p style="margin: 8px 0; font-size: 10px">
                      - Kwh Cumac : <strong>15 600</strong> - Prime CEE :
                      <strong>81,00 €</strong>
                    </p>
                  </td>
                </tr>
                <tr>
                  <td>
                    <p style="margin: 8px 0; font-size: 10px">
                      Matériel(s) fourni(s) et mis en place par notre société
                      <strong>NOVECOLOGY</strong>, SIRET <br />
                      <strong>84994780900026</strong>, Certificat rge Numéro
                      <strong>QPAC/59003</strong> attribué le
                      <strong>04/09/2021</strong> valable <br />
                      jusqu'au <strong>04/09/2022</strong>
                    </p>
                  </td>
                </tr>
                <tr>
                  <td>
                    <p style="margin: 8px 0">
                      <strong
                        >FORFAIT FOURNITURE BALLON THERMODYNAMIQUE THALEOS
                        PERFORMER</strong
                      >
                    </p>
                  </td>
                  <td><p style="font-size: 10px">1,00 U</p></td>
                  <td><p style="font-size: 10px">1 160,50 €</p></td>
                  <td><p style="font-size: 10px">1 160,50 €</p></td>
                  <td><p style="font-size: 10px">5,50 %</p></td>
                </tr>
                <tr>
                  <td>
                    <p style="font-size: 10px; margin: 8px 0">
                      - Capacité : 200 <br />
                      - ETAS: 116% <br />
                      - Profil de soutirage : L <br />
                      - Classe ERP : A+ <br />
                      - COP à 7°C : 2.78 <br />
                      - Appoint électricité intégré : 1800 W <br />
                      - Fluide frigorigène : R513A <br />
                      - Température de fonctionnement C° : -5 à +43 <br />
                      - Hauteur : 1617 mm <br />
                      - Diamètre : 620 mm <br />
                      - Poids à vide : 80kg
                    </p>
                  </td>
                </tr>
                <tr>
                  <td>
                    <p style="margin: 8px 0">
                      <strong>Main d'Œuvre Chauffe Eau Thermodynamique</strong>
                    </p>
                  </td>
                  <td>
                    <p style="font-size: 10px">1,00</p>
                  </td>
                  <td><p style="font-size: 10px">520,11 €</p></td>
                  <td><p style="font-size: 10px">520,11 €</p></td>
                  <td><p style="font-size: 10px">5,50 %</p></td>
                </tr>
                <tr>
                  <td>
                    <p style="font-size: 10px; margin: 8px 0">
                      Pose, fournitures et accessoires complementaires
                    </p>
                  </td>
                </tr>
              </table>
            </td>
          </tr> --}}
          {{-- <tr>
            <td style="border-bottom: 2px solid #000000">
              <table style="width: 100%">
                <tr>
                  <td
                    style="
                      width: 50%;
                      font-size: 14px;
                      font-weight: 700;
                      color: #000000;
                    "
                  >
                    <strong>DEVIS: DV7835 du 02/06/2022</strong>
                  </td>
                  <td
                    style="
                      width: 50%;
                      font-size: 14px;
                      font-weight: 700;
                      color: #000000;
                    "
                  >
                    <strong>M. CALAME PATRICK CHARLES LEON</strong>
                  </td>
                </tr>
              </table>
            </td>
          </tr> --}}
          {{-- <tr>
            <td>
              <table cellpadding="0" cellspacing="0" style="width: 100%">
                <tr class="border-bottom">
                  <th style="font-size: 14px" align="left">
                    <p style="margin: 8px 0"><strong>Détail</strong></p>
                  </th>
                  <th style="font-size: 14px">
                    <strong>Quantité</strong>
                  </th>
                  <th style="font-size: 14px">
                    <strong>P.U TTC</strong>
                  </th>
                  <th style="font-size: 14px">
                    <strong>Total TTC</strong>
                  </th>
                  <th style="font-size: 14px">
                    <strong>TVA</strong>
                  </th>
                </tr>
              </table>
            </td>
          </tr> --}}
          <tr>
            <td>
              <table>
                <tr>
                  <td>
                    <p style="margin: 8px 0">
                      <strong
                        >(**) Conditions particulières relatives à l'aide ANAH /
                        MaPrimeRénov’</strong
                      >
                    </p>
                  </td>
                </tr>
                <tr>
                  <td>
                    <p style="margin-top: 5px; font-size: 10px">
                      Cette offre est cumulable avec l'aide MaPrimeRénov',
                      accordée uniquement après analyse du dossier, d'un montant
                      estimatif de 12 200,00 €. Dans le cas où l’aide notifiée
                      au client est inférieure au montant de l’aide
                      prévisionnelle, l’usager n’est pas lié par le devis et
                      l’entreprise s’engage à proposer un devis rectificatif. Le
                      client conserve alors un droit de rétractation d’une durée
                      de quatorze jours à partir de la date de présentation du
                      devis rectificatif.
                      <br />
                      L’aide MaPrimeRénov’ est conditionnelle et soumise à la
                      conformité des pièces justificatives et informations
                      déclarées par le bénéficiaire. En cas de fausse
                      déclaration, de manoeuvre frauduleuse ou de changement du
                      projet de travaux subventionné, le bénéficiaire s’expose
                      au retrait et reversement de tout ou partie de l’aide.Les
                      services de l’Anah pourront faire procéder à tout contrôle
                      des engagements et sanctionner le bénéficiaire et son
                      mandataire éventuel des manquements constatés.
                    </p>
                  </td>
                </tr>
                <tr>
                  <td>
                    <p style="margin: 1px 0">
                      <strong>Termes et conditions CEE</strong>
                    </p>
                  </td>
                </tr>
                <tr>
                  <td>
                    <p style="margin-bottom: 5px; font-size: 10px">
                      {{ $project->sidebar->getDeal->terms_and_conditions ?? '' }}
                    </p>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
          <tr>
            <td>
              <table
                style="background-color: #f0f0ff; width: 100%; padding: 10px"
              >
                <tr>
                  <td style="width: 50%; vertical-align: baseline">
                    Apposer signature précédée de la mention "Bon pour accord"
                    Le :
                  </td>
                  <td style="font-size: 12px">
                    <table style="width: 100%">
                      <tr>
                        <td style="width: 70%" align="right">Total H.T</td>
                        <td style="width: 30%" align="right">{{ $project->getPrestations->sum('total_ttc') - $project->getPrestations->sum('tva') }} €</td>
                      </tr>
                      <tr>
                        <td style="width: 70%" align="right">Total TVA 5,5%</td>
                        <td style="width: 30%" align="right">{{ $project->getPrestations->sum('tva') }} €</td>
                      </tr>
                      <tr>
                        <td style="width: 70%" align="right">
                          <strong>Total TTC</strong>
                        </td>
                        <td style="width: 30%" align="right">
                          <strong>{{ $project->getPrestations->sum('total_ttc') }} €</strong>
                        </td>
                      </tr>
                      <tr>
                        <td style="width: 70%" align="right">Prime CEE *</td>
                        <td style="width: 30%" align="right">- {{ $project->getOperation->sum('total_ttc') }} €</td>
                      </tr>
                      <tr>
                        <td style="width: 70%" align="right">
                          Estimation MaPrimeRenov'
                        </td>
                        <td style="width: 30%" align="right">- 0 €</td>
                      </tr>
                      <tr>
                        <td style="width: 70%; font-size: 10px" align="right">
                          Sous réserve de l'accord de l'ANAH (**)
                        </td>
                        <!-- <td style="width: 25%" align="right">- 12 200,00 €</td> -->
                      </tr>
                      <tr>
                        <td
                          style="width: 70%; color: #f01; font-weight: 700"
                          align="right"
                        >
                          Reste à payer
                        </td>
                        <td
                          style="width: 30%; color: #f01; font-weight: 700"
                          align="right"
                        >
						{{ $project->getPrestations->sum('total_ttc') - $project->getOperation->sum('total_ttc') }} €
                        </td>
                      </tr>
                      <tr>
                        <td style="width: 70%; font-size: 10px" align="right">
                          Sous réserve de l'accord de l'ANAH (**)
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
                <tr>
                  <td style="font-size: 10px">
                    Ce devis est gratuit, sa date de validité est de 90 jours.
                    <br />
                    Mode de paiement : Chèques, virement ou espèce <br />
                    Délais d'exécution des travaux : 6 mois après acceptation du
                    devis
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </tbody>
        <tfoot>
          <tr>
            <td align="center" style="font-size: 12px">
              <p style="margin: 8px 0">
                NOVECOLOGY – 2 Rue du Pre` des Aulnes 77340 Pontault-Combault –
                01 87 66 57 30 –
                <a href="mailto:abc@gmail.com">support@novecology</a>.fr <br />
                SAS au capital de 10 000€ - SIRET 849 947 809 00026 - APE / NAF
                4322B – TVA FR74 849 947 809 - RGE E-E179070 <br />
                Assurance de responsabilité décennale SV75020721/05052 ,
                souscrite auprès de ERGO France numéro ORIAS 07 000 197
              </p>
            </td>
          </tr>
        </tfoot>
      </table>
    </div>
  
    {{-- <div class="page" style="page-break-before: always;">
        <table
          cellpadding="0"
          cellspacing="0"
          style="width: 100%; font-family: sans-serif">
          <tr>
            <td>
              <table>
                <tr>
                  <td style="width: 50%; vertical-align: baseline">
                    <table style="width: 100%; border-spacing: 25px">
                      <tr>
                        <td>
                          <table style="width: 100%">
                            <tr>
                              <td style="text-align: center; font-size: 8px">
                                CONDITIONS GENERALES DE VENTE NOVECOLOGY
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table>
                            <tr>
                              <td style="font-size: 9px">
                                <strong>PREAMBULE</strong>
                              </td>
                            </tr>
                            <tr>
                              <td
                                style="
                                  font-size: 7px;
                                  text-align: justify;
                                  line-height: 10px;
                                  letter-spacing: 0.3px;
                                "
                              >
                                Les présentes Conditions générales de vente
                                (ci-après les «
                                <strong style="font-weight: 800">CGV</strong> »)
                                sont applicables à la vente hors établissement par
                                la société NOVECOLOGY, Société par actions
                                simplifiée (SAS) - Capital de 10 000 euros - SIRET
                                : 84994780900026 - NAF-APE : 4322B - Numéro TVA FR
                                74 849 947 809 dont le siège social est situé 2
                                RUE DU PRE DES AULNES 77340 PONTAULT-COMBAULT ,
                                représentée par NS Président et ci-après dénommée
                                «
                                <strong style="font-weight: 800"
                                  >la Société</strong
                                >
                                » ou le «
                                <strong style="font-weight: 800">Vendeur</strong>
                                » de produits et installations destinés à
                                favoriser le renouvellement de l’énergie, et
                                notamment les pompes à chaleur, les chaudières à
                                granules, les ballons (ecs) thermodynamiques,
                                ballons thermo-solaire, et isolations extérieures
                                et intérieures et les biens accessoires à ces
                                installations et/ou les prestations commandées
                                (ci-après les «
                                <strong style="font-weight: 800">Produits</strong>
                                ») tels que précisés également en article 2 et sur
                                le Devis au sens de l’article 3.1. ci-après auprès
                                des consommateurs tels que définis par la Loi et
                                la jurisprudence, et notamment toute personne
                                physique ou toute personne morale agissant à titre
                                privé et/ou agissant à des fins qui n’entrent pas
                                dans le cadre de son activité commerciale,
                                industrielle, artisanale ou libérale et disposant
                                de sa pleine capacité (ci-après l’ «
                                <strong style="font-weight: 800">Acheteur</strong>
                                »).
                                <br />
                                Les Produits proposés à la vente sont réservés aux
                                Acheteurs résidant en France métropolitaine et
                                pour des livraisons et installations dans cette
                                même zone géographique. <br />
                                Le vente hors établissement est notamment la vente
                                qui est conclue en la présence physique simultanée
                                du Vendeur et de l’Acheteur, ailleurs que dans
                                l’établissement commercial du Vendeur. <br />
                                Il est ici rappelé que l’article L. 221-10 du Code
                                de la consommation, reproduit intégralement
                                ci-après, dispose qu’avant expiration du délai de
                                réflexion de 7 jours visé ci-après en annexe, le
                                Vendeur ne peut recevoir de l’Acheteur directement
                                ou indirectement, à quelque titre ni sous quelque
                                forme que ce soit, aucun paiement.
                                <br />
                                Toutes les communications, notifications ou mises
                                en demeure prévues aux CGV adressées à la société
                                NOVECOLOGY seront faites par lettre recommandée
                                avec accusé de réception à l’adresse postale
                                suivante : NOVECOLOGY : 2 rue du Pré des Aulnes
                                77340 Pontault Combault, ou par mail à l’adresse
                                e-mail suivante: support@novecology.fr. En outre,
                                sont précisées les coordonnées suivantes : <br />
                                - Service clientèle : 01 87 66 57 30 <br />
                                - Service après-vente : 01 87 66 57 30
                              </td>
                            </tr>
                            <tr style="font-size: 9px">
                              <td><strong>ARTICLE 1 : OBJET DES CGV</strong></td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table>
                            <tr style="font-size: 9px">
                              <td><strong>ARTICLE 1 : OBJET DES CGV</strong></td>
                            </tr>
                            <tr>
                              <td
                                style="
                                  font-size: 7px;
                                  text-align: justify;
                                  line-height: 10px;
                                  letter-spacing: 0.3px;
                                "
                              >
                                <strong style="color: #000000; font-weight: 800"
                                  >1. 1. Documents contractuels</strong
                                >
                                - Les CGV constituent avec le Devis, les documents
                                contractuels opposables aux parties, à l’exclusion
                                de tous <br />
                                <strong style="font-weight: 800"
                                  >1. 2. Acceptation et opposabilité des
                                  CGV</strong
                                >
                                - L’Acheteur déclare avoir pris connaissance des
                                CGV et du Devis avant de passer une Commande, et
                                les accepter sans réserve. En conséquence, le fait
                                de passer Commande implique l’adhésion entière et
                                sans réserve de l’Acheteur à ces CGV. En cas de
                                contradiction entre les présentes CGV et des
                                conditions particulières du contrat qui seront
                                éventuellement émises, ces dernières prévaudront.
                                Toute dérogation à l’une quelconque des CGV doit
                                faire l’objet d’une convention expresse écrite.
                                <br />
                                <strong style="font-weight: 800"
                                  >1. 3. Clauses des CGV</strong
                                >
                                - Si l’une quelconque des stipulations des CGV
                                était annulée, cette nullité n’entraînerait pas la
                                nullité des autres dispositions des documents
                                contractuels qui demeureront en vigueur entre les
                                parties. Le fait pour l’une des Parties de ne pas
                                se prévaloir d’un engagement par l’autre Partie à
                                l’une quelconque des obligations visées par les
                                présentes, ne saurait être interprété pour
                                l’avenir comme une renonciation à l’obligation en
                                cause, toutes les clauses des CGV continuant à
                                produire leurs effets
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table>
                            <tr>
                              <td style="font-size: 9px">
                                <strong>ARTICLE 2 : PRODUITS</strong>
                              </td>
                            </tr>
                            <tr>
                              <td
                                style="
                                  font-size: 7px;
                                  text-align: justify;
                                  line-height: 10px;
                                  letter-spacing: 0.3px;
                                "
                              >
                                <strong style="font-weight: 800"
                                  >2. 1. Caractéristiques</strong
                                >
                                - Les Produits offerts à la vente font chacun
                                l’objet d’un descriptif mentionnant leurs
                                caractéristiques essentielles et le prix des biens
                                et services vendus au sens des articles L. 111-1
                                et L 111-4 du code de la consommation, ainsi que
                                les dates de livraison des Produits qui, par
                                défaut, sont celles prévues aux termes de
                                <strong style="font-weight: 800"
                                  >l’article « 4 – Livraison</strong
                                >
                                ». Les matériaux vendus et les prestations
                                commandées sont identifiés au recto. <br />
                                L’Acheteur a préalablement à sa Commande pris
                                connaissance des caractéristiques essentielles des
                                Produits commandés en consultant les informations
                                précontractuelles qui lui ont été communiquées par
                                le Vendeur. Les photographies et les graphismes
                                figurant sur le catalogue ou le site Internet ne
                                sont donnés qu’à titre indicatif et ne sauraient
                                constituer un engagement contractuel du Vendeur
                                garantissant une similitude parfaite entre le
                                Produit commandé et le Produit représenté. Il est
                                précisé que le Vendeur fournit et installe, ou
                                fait installer par un installateur agréé par lui,
                                les Produits vendus. Il peut également assister
                                l’Acheteur dans les démarches administratives
                                inhérentes à cette installation comme précisé à
                                <strong style="font-weight: 800"
                                  >l’article 10 – Démarches
                                  administratives</strong
                                >. Ces prestations, définies le cas échéant dans
                                le Devis ou des conditions particulières, excluent
                                la maintenance et l’entretien du Produit installé.
                                Le Vendeur peut actualiser, améliorer ses fiches
                                Produits ou retirer de la vente certains Produits.
                                <br />
                                <strong style="font-weight: 800"
                                  >2. 2. Disponibilité des Produits</strong
                                >
                                - Les Produits sont vendus, livrés et installés
                                dans la limite des stocks disponibles. En cas
                                d’indisponibilité du Produit commandé, le Vendeur
                                en informe immédiatement l’Acheteur et peut lui
                                proposer un produit d’une qualité et d’un prix
                                équivalent. En cas de désaccord de l’Acheteur et
                                si le Vendeur avait perçu des sommes avant
                                l’installation, il procède au remboursement des
                                sommes versées dans un délai de 45 jours maximum à
                                compter du refus de l’Acheteur. En dehors du
                                remboursement du prix du produit indisponible, le
                                Vendeur n’est tenu à aucune indemnité
                                d’annulation.
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table>
                            <tr>
                              <td style="font-size: 9px">
                                <strong>ARTICLE 3 : DEVIS ET COMMANDES</strong>
                              </td>
                            </tr>
                            <tr>
                              <td
                                style="
                                  font-size: 7px;
                                  text-align: justify;
                                  line-height: 10px;
                                  letter-spacing: 0.3px;
                                "
                              >
                                <strong style="font-weight: 800"
                                  >3. 1. Devis</strong
                                >
                                - Tout devis émis par le Vendeur (le «
                                <strong style="font-weight: 800">Devis</strong> »)
                                n’est valable que soixante (60) jours à compter de
                                sa date d’émission. Au-delà de ce délai, le
                                Vendeur ne pourra être lié que sur acceptation
                                expresse de sa part. A défaut, un nouveau Devis
                                sera adressé à l’Acheteur.
                                <br />
                                Le Vendeur n’est lié par une Commande que
                                lorsqu’il est en possession d’un Devis émis par
                                ses soins et accepté par l’Acheteur dans le délai
                                de 60 jours, sans surcharge ni rature et signé au
                                recto pour acceptation des conditions
                                particulières, des CGV et reconnaissance par
                                l’Acheteur qu’il a reçu l’ensemble des
                                informations précontractuelles conformément aux
                                dispositions de l’article L111-1 du code de la
                                consommation et notamment les caractéristiques
                                essentielles et le prix des Produits <br />
                                La signature du Devis dans les conditions
                                précitées emporte Commande de la part de
                                l’Acheteur. <br />
                                Le bénéfice de la Commande est personnel à
                                l’Acheteur et ne peut être cédé sans l’accord du
                                Vendeur. <br />
                                <strong style="font-weight: 800"
                                  >3. 2. Caractère définitif de la
                                  Commande</strong
                                >
                                – L’Acheteur est informé qu’il est engagé par sa
                                Commande sous réserve du droit légal de
                                rétractation détaillée à
                                <strong style="font-weight: 800"
                                  >l’article « 7 – Droit de rétractation »</strong
                                >. <br />
                                Les Commandes étant définitives et irrévocables,
                                sous la condition de la prise en charge par l’ANAH
                                (Agence Nationale pour l’Habitat) dans des
                                conditions précisées au verso, toute demande de
                                modification faite par l’Acheteur est soumise à
                                l’acceptation du Vendeur <br />
                                <strong style="font-weight: 800"
                                  >3. 3. Modification de la Commande</strong
                                >
                                - Toute modification de la Commande par l’Acheteur
                                est soumise à l’acceptation expresse du Vendeur.
                                Le Vendeur se réserve le droit d’apporter au
                                Produit commandé les modifications qui sont liées
                                à l’évolution technique dans les conditions
                                prévues à l’article R. 212-4 dernier alinéa du
                                code de la consommation. <br />
                                <strong style="font-weight: 800"
                                  >3. 4. Refus de la Commande</strong
                                >
                                - Le Vendeur se réserve le droit de refuser toute
                                Commande pour des motifs légitimes et plus
                                particulièrement si les quantités de matériel
                                commandées sont anormalement élevées pour des
                                acheteurs ayant la qualité de consommateurs,
                                lorsqu’il existe un litige avec l’Acheteur
                                concernant le paiement d’une Commande antérieure
                                ou si le site d’installation du Produit choisi par
                                l’Acheteur présente des contre-indications
                                techniques pour l’installation de ce Produit.
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table>
                            <tr>
                              <td style="font-size: 9px">
                                <strong style="font-weight: 800"
                                  >ARTICLE 4 : LIVRAISON
                                </strong>
                              </td>
                            </tr>
                            <tr>
                              <td
                                style="
                                  font-size: 7px;
                                  text-align: justify;
                                  line-height: 10px;
                                  letter-spacing: 0.3px;
                                "
                              >
                                <strong style="font-weight: 800">4.1.</strong> -
                                La livraison s’entend de la remise directe des
                                produits vendus à l’Acheteur à son domicile.
                                <br />
                                Elle emporte transfert à l’Acheteur de la
                                possession physique ou du contrôle du Produit
                                <br />
                                <strong style="font-weight: 800">4.2.</strong> - A
                                compter de la notification par l’Acheteur au
                                Vendeur du montant de la subvention à verser par
                                l’ANAH émanant directement de l’Agence National de
                                l’Habitat, le Vendeur s’engage à livrer les
                                Produits dans un délai maximum de 3 (trois) mois ;
                                il est toutefois rappelé que le délai mentionné
                                lors de la Commande est un délai prévisionnel.
                                <br />
                                <strong style="font-weight: 800">4.3.</strong> -
                                Lorsque le Produit commandé n’est pas livré et/ou
                                la prestation exécutée à la date ou à l’expiration
                                du délai visé ci-dessus et sauf causes de
                                prorogation précisées ci-après à l’article 4.4.,
                                l’Acheteur peut, après avoir enjoint sans succès
                                le Vendeur à exécuter son obligation de livraison
                                dans un délai supplémentaire raisonnable, résoudre
                                la Commande par lettre recommandée avec demande
                                d’avis de réception ou par un écrit sur un autre
                                support durable. <br />
                                <strong style="font-weight: 800">4.4.</strong> -
                                Le délai de livraison peut être prorogé en cas de
                                survenance d’un cas fortuit, d’un cas de force
                                majeure, d’une pandémie ou d’une épidémie donnant
                                lieu à des mesures législatives ou règlementaires
                                restreignant l’activité du Vendeur, de ses
                                fournisseurs ou de son personnel, ou d’une cause
                                légitime de suspension du délai ; la prorogation
                                sera égale au nombre de jours pendant lesquels
                                l’événement considéré fait obstacle à l’exécution
                                de la Commande. Outre les cas visés ci-dessus, le
                                délai de livraison pourra être prorogé en cas
                                d’impossibilité d’accéder dans des conditions
                                normales au site de livraison désigné par
                                l’Acheteur ou encore en cas d’indisponibilité de
                                l’Adhérent à plus de 3 dates proposées pour
                                l’exécution des prestations
                                <br />
                                <strong style="font-weight: 800">4.5.</strong> -
                                Les Produits sont livrés à l’adresse indiquée par
                                l’Acheteur sur le Devis. <br />
                                <strong style="font-weight: 800">4.6.</strong> -
                                La livraison des Produits donne lieu à la
                                signature d’un « bon de livraison ».
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table>
                            <tr>
                              <td style="font-size: 9px">
                                <strong style="font-weight: 800"
                                  >ARTICLE 5 : EXECUTION DES TRAVAUX
                                </strong>
                              </td>
                            </tr>
                            <tr>
                              <td
                                style="
                                  font-size: 7px;
                                  text-align: justify;
                                  line-height: 10px;
                                  letter-spacing: 0.3px;
                                "
                              >
                                L’installation et la mise en service des Produits
                                sont assurées, sous réserve de l’exercice par
                                l’Acheteur de son droit de rétractation tel que
                                précisé à
                                <strong style="font-weight: 800"
                                  >l’article 7</strong
                                >
                                ci-après, concomitamment et exclusivement par le
                                Vendeur ou par toute personne ou société dûment
                                mandatée par ce dernier. Pour la réalisation de
                                ces opérations, l’Acheteur s’engage à laisser
                                libre accès aux locaux sur lesquels l’intervention
                                du Vendeur sera réalisée <br />
                                L’Acheteur s’engage à faciliter l’intervention des
                                personnes en charge de l’installation. A défaut il
                                engage sa responsabilité. En tout état de cause,
                                le Vendeur ne saurait être tenu responsable d’un
                                éventuel retard de livraison ou d’installation dû
                                à un refus d’accès au technicien par l’Acheteur.
                                <br />
                                La durée d’exécution des travaux est variable
                                selon les difficultés propres au chantier. Le
                                Vendeur s’engage à en limiter au maximum la durée
                                <br />
                                L’Acheteur devra prendre toutes mesures utiles
                                pour que les risques nés de l’installation du
                                Produit soient assurés.
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table>
                            <tr>
                              <td style="font-size: 9px">
                                <strong style="font-weight: 800"
                                  >ARTICLE 6 : RECEPTION
                                </strong>
                              </td>
                            </tr>
                            <tr>
                              <td
                                style="
                                  font-size: 7px;
                                  text-align: justify;
                                  line-height: 10px;
                                  letter-spacing: 0.3px;
                                "
                              >
                                Dès que les Produits sont installés conformément
                                aux prévisions contractuelles, l’Acheteur signe le
                                procès-verbal d’installation et/ou de réception.
                                Il appartient à l’Acheteur de vérifier en présence
                                de l’installateur, l’état et le bon fonctionnement
                                des Produits installés et, en cas d’avarie ou de
                                manquants, d’émettre des réserves sur le
                                procès-verbal d’installation et/ou de réception.
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table>
                            <tr>
                              <td style="font-size: 9px">
                                <strong>ARTICLE 7 : DROIT DE RETRACTATION</strong>
                              </td>
                            </tr>
                            <tr>
                              <td
                                style="
                                  font-size: 7px;
                                  text-align: justify;
                                  line-height: 10px;
                                  letter-spacing: 0.3px;
                                "
                              >
                                <strong style="font-weight: 800"
                                  >7.1 Conditions, délais et modalités d’exercice
                                  du droit de rétractation</strong
                                >
                                <br />
                                En application de l’article L 221-18 et suivants
                                du code de la consommation, l’Acheteur dispose
                                d’un délai de rétractation de tout ou partie de sa
                                Commande, sans motif, et qui expire quatorze (14)
                                jours à compter du jour de réception de la
                                commande dans le cas d’un contrat portant
                                fourniture de bien ou à compter de la signature du
                                contrat de vente en cas de prestation de services
                                <br />
                                Conformément à l’article L.221 -28 du Code de la
                                consommation, ce délai de rétractation n’est pas
                                applicable notamment pour l’achat de produits
                                confectionnés selon les spécifications du
                                consommateur ou nettement personnalisés <br />
                                Le droit de rétractation se fait à la charge de
                                l’Acheteur suivant les modalités ex- posées
                                ci-dessous.
                                <br />
                                L’Acheteur peut se rétracter dans le délai légal
                                sans avoir à donner de motif et sans frais. <br />
                                <strong style="font-weight: 800"
                                  >7.2 Modalités d’exercice du droit de
                                  rétractation</strong
                                >
                                <br />
                                Pour exercer son droit de rétractation, l’Acheteur
                                devra notifier au Vendeur sa décision de se
                                rétracter du présent contrat au moyen d’une
                                déclaration claire et dénuée d’ambiguïté à
                                l’adresse suivante et ce dans les quatorze (14)
                                jours à compter du jour de réception de la
                                commande dans le cas d’un contrat portant
                                fourniture de bien ou à compter de la signature du
                                contrat de vente en cas de prestation de services
                                par voie postale (par courrier recommandé A/R) :
                                <span style="text-decoration: underline"
                                  >NOVECOLOGY 2 RUE DU PRE DES AULNES 77340
                                  PONTAULT-COMBAULT</span
                                >
                                <br />
                                S’il le souhaite, l’Acheteur peut également
                                utiliser le modèle de formulaire de rétractation
                                disponible en annexe des présentes conditions
                                générales de vente.
                                <br />
                                <strong style="font-weight: 800"
                                  >7.3 Effets de la rétractation</strong
                                >
                                <br />
                                L’exercice du droit de rétractation met fin à
                                l’obligation des parties d’exécuter le contrat.
                                <br />
                                Ainsi, lorsque l’Adhérents exerce son droit de
                                rétractation dans le délai légal, la Société
                                s’engage à lui rembourser le montant du prix perçu
                                dans un délai de 14 (quatorze) jours à compter de
                                la réception du formulaire de rétractation. Ce
                                remboursement sera effectué en utilisant le même
                                moyen de paiement que celui que l’Acheteur a
                                choisi pour la transaction initiale, sauf si
                                l’Acheteur convient expressément d’un moyen
                                différent.
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table>
                            <tr>
                              <td style="font-size: 9px">
                                <strong style="font-weight: 800"
                                  >ARTICLE 13 : Clause de dédit
                                </strong>
                              </td>
                            </tr>
                            <tr>
                              <td
                                style="
                                  font-size: 7px;
                                  text-align: justify;
                                  line-height: 10px;
                                  letter-spacing: 0.3px;
                                "
                              >
                                L’Acheteur s’engage à payer en cas d’annulation de
                                sa commande au-delà du délai légal de
                                rétractation, un montant égal à 50% du prix TTC du
                                devis (hors aides) à titre d’indemnité pour le
                                Vendeur qui aurait déjà tout mis en œuvre pour
                                répondre de cette commande
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table>
                            <tr>
                              <td style="font-size: 9px">
                                <strong
                                  >ARTICLE 14 : GARANTIE LÉGALE DE CONFORMITÉ ET
                                  GARANTIE DES VICES CACHÉS (GARANTIES
                                  LÉGALES)</strong
                                >
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table>
                            <tr>
                              <td
                                style="
                                  font-size: 7px;
                                  text-align: justify;
                                  line-height: 10px;
                                  letter-spacing: 0.3px;
                                  border: 1px solid #000000;
                                  padding: 3px 10px;
                                "
                              >
                                Lorsqu’il agit en garantie légale de conformité,
                                le consommateur bénéficie d’un délai de deux ans à
                                compter de la délivrance du bien pour agir ; il
                                peut choisir entre la réparation ou le
                                remplacement du bien, sous réserve des conditions
                                de coût prévues par l’article L211-9 du Code de la
                                consommation ; sauf pour les biens d’occasion, il
                                est dispensé de prouver l’existence du défaut de
                                conformité du bien durant les six mois suivant la
                                délivrance du bien, délai porté à 24 mois à
                                compter du 18 mars 2016. <br />
                                <span style="display: block; margin: 5px 0"
                                  >La garantie légale de conformité s’applique
                                  indépendamment de la garantie commerciale
                                  éventuellement consentie par le Vendeur.
                                </span>
                                <span style="display: block; margin-bottom: 5px"
                                  >Le consommateur peut décider de mettre en œuvre
                                  la garantie contre les défauts cachés de la
                                  chose vendue au sens de l’article 1641 du Code
                                  civil, à moins que le vendeur n’ait stipulé
                                  qu’il ne sera obligé à aucune garantie ; dans
                                  l’hypothèse d’une mise en œuvre de cette
                                  garantie, l’acheteur a le choix entre la
                                  résolution de la vente ou une réduction du prix
                                  de vente conformément à l’article 1644 du Code
                                  civil. Il dispose d’un délai de deux années à
                                  compter de la découverte du vice</span
                                >
                                <span style="display: block"
                                  >Le report, la suspension ou l’interruption de
                                  la prescription ne peut avoir pour effet de
                                  porter le délai de prescription extinctive
                                  audelà de vingt ans à compter du jour de la
                                  naissance du droit conformément à l’article 2232
                                  du Code civil.
                                </span>
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table>
                            <tr>
                              <td
                                style="
                                  font-size: 7px;
                                  text-align: justify;
                                  line-height: 10px;
                                  letter-spacing: 0.3px;
                                "
                              >
                                Les garanties légales s'appliqueront
                                indépendamment de la garantie commerciale
                                éventuellement proposée par le Vendeur et qui
                                ferait l’objet d’un contrat de garantie
                                commerciale distinct.
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table>
                            <tr>
                              <td
                                style="
                                  font-size: 7px;
                                  text-align: justify;
                                  line-height: 10px;
                                  letter-spacing: 0.3px;
                                "
                              >
                                <strong style="font-weight: 800"
                                  >14. 1. La garantie légale de conformité</strong
                                >
                                - Tous les produits fournis par le Vendeur
                                bénéficient de la garantie légale de conformité
                                prévue aux articles L. 217-4 à L. 217-14 du Code
                                de la consommation ou de la garantie des vices
                                cachés prévue aux articles 1641 à 1649 du Code
                                civil. Le Vendeur doit livrer un bien conforme au
                                contrat. A défaut il est responsable des défauts
                                lors de la délivrance, mais également de tout ceux
                                résultant de l’emballage, des instructions de
                                montage ou de l’installation lorsqu’elle est à la
                                charge du contrat ou sous sa responsabilité.
                                <br />
                                L’action en garantie de conformité se prescrit par
                                2 ans à compter de la délivrance du bien.
                                Lorsqu’il y a défaut de conformité, le
                                professionnel propose au consommateur le
                                remplacement du bien ou sa réparation. Le choix
                                dépend du consommateur, sauf lorsque celui - ci
                                engendre pour le professionnel des coûts
                                disproportionnés par rapport à second moyen.
                                <br />
                                Le consommateur peut obtenir la résolution du
                                contrat ou sa réfaction (réduction du prix du
                                bien) si le défaut est majeur et que le délai de
                                la solution choisie excède 1 mois à partir de la
                                demande ; ou qu’aucun moyen n’est réalisable.
                                <br />
                                Aucun frais ne peut être demandé au consommateur
                                pour le remplacement, la réparation, la résolution
                                ou la réfaction du contrat. <br />
                                <strong style="font-weight: 800"
                                  >14. 2. La garantie des défauts cachés</strong
                                >
                                - Le Vendeur est par ailleurs tenu de la garantie
                                à raison des défauts cachés de la chose vendue qui
                                la rendent impropre à l’usage auquel on la
                                destine, ou qui diminuent tellement cet usage, que
                                l’Acheteur ne l’aurait pas acquise, ou n’en aurait
                                donné qu’un moindre prix, s’il les avait connus
                                <br />
                                La garantie légale couvre tous les frais entraînés
                                par les vices cachés. L’Acheteur à ici le choix
                                soit de rendre la chose et se faire restituer le
                                prix soit de garder la chose et se faire rendre
                                une partie du prix. Le délai pour agir est de 2
                                ans à compter de la découverte du vice. Les
                                produits sont vendus sous la seule garantie du
                                fabricant et sont assortis d’un bon de garantie
                                remis à l’Acheteur par le Vendeur <br />
                                La garantie du fabricant sur le matériel s’étend
                                sur une durée de 3 ans pour les pièces, 5 ans pour
                                les compresseurs, 5 ans sur les onduleurs. Les
                                cellules composant les modules sont garanties 25
                                ans à 80% de leur puissance normale. Cette
                                garantie prévoit l ’échange gratuit de la pièce
                                défectueuse en usine. Les frais de dépose, pose et
                                transport sont à la charge de l’Adhérent. La
                                garantie sur une pièce de remplacement expire en
                                même temps que celle de la pièce remplacée. Tous
                                les autres éléments tels que diffuseurs, panneaux
                                solaires, ballons d’eau chaude, sanitaires,
                                télécommandes, composants électroniques, pompes de
                                relevage, disjoncteurs, liaison frigorifiques,
                                câbles électriques, goulottes, etc ... sont
                                garantis un an. En cas de dommages dus au
                                transport des articles susvisés, il appartient à
                                l’Acheteur d’en faire la réserve dès la livraison
                                et d’en aviser le Vendeur <br />
                                En cas d’invocation de la garantie, la
                                présentation du certificat de garantie sera
                                rigoureusement exigée. Le Vendeur s’engage à
                                intervenir dans un délai de 30 jours à compter de
                                la réception de la demande d’intervention, qui
                                sera obligatoirement formulée par écrit avec
                                accusé de réception, sous réserve d’être en
                                possession des éléments nécessaires à la
                                réparation ou au remplacement
                                <br />
                                <strong style="font-weight: 800"
                                  >14.3. Garantie décennale</strong
                                >
                                - L’assurance de responsabilité civile décennale
                                garantit la réparation des dommages qui se
                                produisent après la réception des travaux. La
                                garantie décennale concerne les vices ou dommages
                                de construction qui peuvent affecter la solidité
                                de l’ouvrage et de ses équipements indissociables
                                ou qui la rendent inhabitable ou impropre à
                                l’usage auquel il est destiné <br />
                                La garantie décennale couvre le dommage résultant
                                d’un défaut de conformité affectant le gros
                                ouvrage (murs, charpente, toiture, etc.) mais
                                également les éléments d’équipement lorsque les
                                dysfonctionnements les affectant rendent le bien
                                dans son ensemble impropre à sa destination <br />
                                La garantie décennale couvre les dommages survenus
                                après la réception des travaux, pendant une durée
                                de 10 ans.
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table>
                            <tr>
                              <td style="font-size: 9px">
                                <strong style="font-weight: 800"
                                  >ARTICLE 15 : Exclusion de responsabilité et
                                  force majeure</strong
                                >
                              </td>
                            </tr>
                            <tr>
                              <td
                                style="
                                  font-size: 7px;
                                  text-align: justify;
                                  line-height: 10px;
                                  letter-spacing: 0.3px;
                                "
                              >
                                <strong style="font-weight: 800"
                                  >15.1.- Exclusion de responsabilité</strong
                                >
                                - La responsabilité du Vendeur ne peut être
                                engagée dans les cas suivants : <br />
                                <ul
                                  style="
                                    margin-left: 13px;
                                    margin-top: 5px;
                                    line-height: 12px;
                                  "
                                >
                                  <li>
                                    Non-paiement partiel ou total du montant de la
                                    commande ;
                                  </li>
                                  <li>
                                    Détérioration des appareils provenant
                                    directement ou indirectement d’accidents de
                                    toutes sortes, chocs, surtensions, foudre,
                                    inondations, incendie, et d’une manière
                                    générale, toutes autres causes autre que
                                    celles résultant d’une utilisation normale ;
                                  </li>
                                  <li>
                                    Mauvais fonctionnement résultant d’adjonction
                                    de pièces ou dispositifs ne provenant pas du
                                    Vendeur ;
                                  </li>
                                  <li>
                                    Intervention de quelque nature que ce soir par
                                    une personne non agréée par le Vendeur ;
                                  </li>
                                  <li>
                                    Variation du courant électrique, dérangement,
                                    panne ou rupture des lignes téléphoniques ;
                                  </li>
                                  <li>
                                    Modifications dommageables de l’environnement
                                    de l’appareil (température, hygrométrie,
                                    poussières) ;
                                  </li>
                                  <li>
                                    Modification des spécifications d’un appareil
                                    ou utilisation non conforme aux
                                    caractéristiques techniques - interférence et
                                    brouillage de toutes sortes, radioélectrique
                                    ou électrique ;
                                  </li>
                                  <li>
                                    Les perturbations de fonctionnement dues à un
                                    évènement relevant de la force majeure ;
                                  </li>
                                  <li>
                                    Non-respect des consignes d’utilisation des
                                    matériaux et ou des notices d’utilisation du
                                    matériel délivré ;
                                  </li>
                                  <li>
                                    Utilisation des appareils dans des conditions
                                    non conformes à leur usage ;
                                  </li>
                                  <li>Défaut d’entretien et de maintenance.</li>
                                  <li>Vices apparents ;</li>
                                  <li>
                                    Défauts et détériorations provoqués par
                                    l’usure naturelle ou par une modification du
                                    produit non prévue
                                  </li>
                                </ul>
                                <br />
                                <strong style="font-weight: 800"
                                  >15.2.- Autres causes d’exclusion de
                                  responsabilité du Vendeur</strong
                                >
                                - La responsabilité du Vendeur ne peut être
                                engagée en cas d’inexécution ou de mauvaise
                                exécution du contrat due, soit au fait de
                                l’Acheteur, soit au fait insurmontable et
                                imprévisible d’un tiers au contrat, soit à un cas
                                de force majeure au sens de l’article 1218 du Code
                                civil. <br />
                                La responsabilité du Vendeur ne saurait être
                                engagée à raison : <br />
  
                                <ul
                                  style="
                                    margin-left: 13px;
                                    margin-top: 5px;
                                    line-height: 12px;
                                  "
                                >
                                  <li>
                                    des conditions d’octroi et de montant du
                                    crédit d’impôt auquel l’Adhérent peut
                                    prétendre ainsi qu’à toute évolution légale ou
                                    réglementaire en la matière ;
                                  </li>
                                  <li>
                                    de toute évolution ou suppression des aides
                                    d’état existantes ou jour de la souscription
                                    du présent contrat par l’Adhérent.
                                  </li>
                                </ul>
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table>
                            <tr>
                              <td style="font-size: 9px">
                                <strong style="font-weight: 800"
                                  >ARTICLE 16 : Réclamations et médiation
                                </strong>
                              </td>
                            </tr>
                            <tr>
                              <td
                                style="
                                  font-size: 7px;
                                  text-align: justify;
                                  line-height: 10px;
                                  letter-spacing: 0.3px;
                                "
                              >
                                <strong style="font-weight: 800"
                                  >16. 1. - Réclamation préalable</strong
                                >
                                - En cas de litige, l’Acheteur doit adresser sa
                                réclamation écrite au Service Clients du Vendeur
                                situé au 2 RUE DU PRE DES AULNES 77340
                                PONTAULT-COMBAULT ainsi qu’au numéro suivant : 01.
                                87 . 66 . 57 . 30 <br />
                                <strong style="font-weight: 800"
                                  >16. 2. Demande de médiation</strong
                                >
                                - En cas d'échec de la demande de réclamation
                                auprès du service consommateurs du Vendeur ou en
                                l'absence de réponse de ce service dans un délai
                                de deux (2) mois, l’Acheteur peut soumettre le
                                différend l'opposant au Vendeur à la Commission
                                Paritaire de Médiation de la Vente Directe : 100,
                                avenue du Président Kennedy 75016 Paris - tél. :
                                01 42 15 30 00 - email : info@fvd.fr, qui
                                recherchera gratuitement un règlement à l'amiable
                                <br />
                                L’Adhérent reconnait que la Commission Paritaire
                                de Médiation de la Vente Directe a compétence
                                exclusive pour traiter, dans le cadre d'un
                                processus de médiation, les différends nés de la
                                Commande, des Produits, ou des CGV. Ni le Vendeur
                                ni l‘Acheteur ne peuvent utiliser un autre système
                                de médiation. <br />
                                L’Adhérent reconnait que la Commission Paritaire
                                de Médiation de la Vente Directe a compétence
                                exclusive pour traiter, dans le cadre d'un
                                processus de médiation, les différends nés de la
                                Commande, des Produits, ou des CGV. Ni le Vendeur
                                ni l‘Acheteur ne peuvent utiliser un autre système
                                de médiation. <br />
                                Les professionnels du secteur ont élaboré des
                                règles déontologiques sous la forme d'un Code
                                éthique envers le consommateur et d'un Code de
                                conduite des entreprises de Vente Directe. Le
                                consommateur peut prendre connaissance de ces
                                Codes sur le site internet de la Fédération de la
                                Vente Directe
                                <a href="https://www.fvd.fr/en/">(www.fvd.fr)</a>.
                                <br />
                                Pour présenter sa demande de médiation, l‘Acheteur
                                dispose d'un formulaire de réclamation accessible
                                sur le site du médiateur. Les parties au contrat
                                restent libres d'accepter ou de refuser le recours
                                à la médiation ainsi que, en cas de recours à la
                                médiation, d'accepter ou de refuser la solution
                                proposée par le médiateur
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table>
                            <tr>
                              <td style="font-size: 9px">
                                <strong
                                  >ARTICLE 17 : Protection des données à caractère
                                  personnel</strong
                                >
                              </td>
                            </tr>
                            <tr>
                              <td
                                style="
                                  font-size: 7px;
                                  text-align: justify;
                                  line-height: 10px;
                                  letter-spacing: 0.3px;
                                "
                              >
                                Conformément à la loi n° 78-17 du 6 janvier 1978
                                modifiée (dite « loi Informatique et Libertés »)
                                et au Règlement Général sur la Protection des
                                Données 2016/679 du 27 avril 2016 (« RGPD »), des
                                données à caractère personnel concernant les
                                Adhérents font l’objet d ’un traitement
                                informatique par le Vendeur agissant en qualité de
                                responsable de traitement pour notamment :
                                effectuer des opérations relatives à la gestion
                                des relations commerciales dans le cadre de la
                                fourniture de tous produits, faciliter l’
                                identification des Adhérents et informer les
                                Adhérents de toute modification apportée aux
                                produits et services NOVECOLOGY les améliorer,
                                mener des actions de prospection et des analyses
                                statistiques.
                                <br />
                                Ces données ne sont pas susceptibles d’être
                                transférées dans des pays non- membres de l’Espace
                                Économique Européen. Pour les stricts besoins de
                                la gestion des relations commerciales, ces données
                                peuvent être communiquées aux partenaires du
                                Vendeur. Ces données sont conservées pendant la
                                durée strictement nécessaire à l’accomplissement
                                des finalités rappelées ci-dessus
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                    </table>
                  </td>


                  <td style="width: 50%; vertical-align: baseline">
                    <table style="width: 100%; border-spacing: 25px">
                      <tr>
                        <td style="vertical-align: baseline">
                          <table>
                            <tr>
                              <td
                                style="
                                  vertical-align: baseline;
                                  font-size: 7px;
                                  line-height: 10px;
                                  letter-spacing: 0.3px;
                                  text-align: justify;
                                "
                              >
                                La responsabilité de l’Acheteur, en cas de
                                rétractation après utilisation du ou des Produits,
                                est engagée à l’égard de la dépréciation du ou des
                                Produits résultant de manipulations autres que
                                celles nécessaires pour établir la nature, les
                                caractéristiques et le bon fonctionnement de ce ou
                                ces Produits. Enfin, le Vendeur pourra récupérer
                                lui-même le Produit La Société peut effectuer le
                                remboursement du produit en différé jusqu’à ce
                                qu’elle ait reçue l’objet du devis ou jusqu’à que
                                l’Adhérent ait fourni une preuve de l’expédition
                                du Produit
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table>
                            <tr>
                              <td
                                style="
                                  font-size: 7px;
                                  line-height: 10px;
                                  letter-spacing: 0.3px;
                                  text-align: justify;
                                "
                              >
                                <strong style="font-weight: 800"
                                  >7.4. Installation des Produits</strong
                                >
                                – Le Vendeur attire l’attention de l’Acheteur sur
                                le fait qu’aucune installation des Produits ne
                                sera effectuée avant l’expiration du droit de
                                rétractation dont il dispose. Par exception à ce
                                qui précède et conformément à l’article L 221-25
                                du Code de la Consommation, et si l’Acheteur en
                                fait la demande expresse et écrite, le Vendeur
                                pourra procéder à l’installation des Produits
                                avant l’expiration du délai de rétractation mais
                                après le délai de sept (7) jours prévus à
                                l’article 8. Dans cette hypothèse, l’Acheteur qui
                                exercerait postérieurement à l’installation des
                                Produits son droit de rétractation sera tenu au
                                paiement d’un montant correspondant au service
                                fourni jusqu’à la communication de sa décision de
                                se rétracter ; ce montant est proportionné au prix
                                total de la prestation convenue. <br />
                                Enfin, le Vendeur attire également l’attention de
                                l’Acheteur sur le fait qu’en cas de demande
                                expresse et écrite d’installation des Produits
                                avant l’expiration du droit de rétractation, il ne
                                pourra plus, conformément aux dispositions de
                                l’article L221-28 du Code de la Consommation,
                                l’exercer : <br />
                                - Pour les services pleinement exécutés avant la
                                fin du délai de rétractation, <br />
                                - Pour les Produits qui auraient été, du fait de
                                leur installation, confectionnés selon les
                                spécifications de l’Acheteur ou nettement
                                personnalisés telles qu’une découpe du Produit par
                                exemple.
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table>
                            <tr>
                              <td
                                style="
                                  font-size: 7px;
                                  line-height: 10px;
                                  letter-spacing: 0.3px;
                                  text-align: justify;
                                "
                              >
                                <strong style="font-weight: 800"
                                  >ARTICLE 8 : PRIX</strong
                                >
                                <br />
                                Les prix de vente sont indiqués, pour chacun des
                                Produits, en euros toutes taxes comprises. Les
                                taxes sont appliquées selon la règlementation en
                                vigueur. <br />
                                Le prix de vente du Produit est celui en vigueur
                                au jour de la Commande. <br />
                                Le Vendeur se réserve le droit de modifier ses
                                prix à tout moment, tout en garantissant à
                                l’Adhérent l’application du prix en vigueur au
                                jour de sa Commande <br />
                                L’Acheteur reconnait avoir été informé des modes
                                et conditions de règlement désignés au Devis ou
                                bon de commande. <br />
                                Conformément aux dispositions de l’article L221
                                -10 du Code de la consommation, le Vendeur
                                s’interdit de percevoir quelque paiement ou
                                contrepartie, sous quelque forme que ce soit, de
                                la part de l’Acheteur avant l’expiration d’un
                                délai de sept (7) jours à compter de la conclusion
                                du contrat hors établissement <br />
                                Le règlement peut s’effectuer par chèque ou
                                virement par mandat SEPA. <br />
                                Tout paiement non effectué dans les délais prévus
                                donne droit, après mise en demeure effectuée par
                                courrier recommandé A/R, au paiement d’intérêts de
                                retard calculés au taux de 8%. <br />
                                Le vendeur se réserve le droit, lorsque le prix
                                convenu n’est pas payé à l’échéance, soit de
                                demander l’exécution de la vente, soit de résoudre
                                le contrat par simple lettre recommandée avec
                                demande d’avis de réception
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table>
                            <tr>
                              <td
                                style="
                                  font-size: 7px;
                                  line-height: 10px;
                                  letter-spacing: 0.3px;
                                  text-align: justify;
                                "
                              >
                                <strong style="font-weight: 800"
                                  >ARTICLE 9 : CLAUSE DE RESERVE DE
                                  PROPRIETE</strong
                                >
                                <br />
                                LE TRANSFERT DE PROPRIÉTÉ DU PRODUIT VENDU EST
                                SUBORDONNÉ AU PAIEMENT INTÉGRAL DES SOMMES DUES EN
                                PRINCIPAL, FRAIS ET ACCESSOIRES À LA SOCIETE
                                NOVECOLOGY MEME EN CAS D’OCTROI DE DÉLAI DE
                                PAIEMENT <br />
                                LES DISPOSITIONS CI-DESSUS NE FONT PAS OBSTACLE AU
                                TRANSFERT A L’ACHETEUR, DES RISQUES DE PERTE OU
                                D’ENDOMMAGEMENT DU PRODUIT SOUMIS À RÉSERVE DE
                                PROPRIÉTÉ, A PARTIR DU MOMENT OU L’ACHETEUR PREND
                                PHYSIQUEMENT POSSESSION DU PRODUIT, SOIT PAR
                                LUI-MEME SOIT PAS UN TIERS QU’IL A DESIGNE <br />
                                L’ACHETEUR S’ENGAGE, TANT QUE LA PROPRIETE NE LUI
                                EST PAS TRANSFEREE, A PRENDRE TOUTES LES
                                PRECAUTIONS UTILES A LA BONNE CONSERVATION DES
                                PRODUITS.
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table>
                            <tr>
                              <td
                                style="
                                  font-size: 7px;
                                  line-height: 10px;
                                  letter-spacing: 0.3px;
                                  text-align: justify;
                                "
                              >
                                <strong style="font-weight: 800"
                                  >ARTICLE 10 : Démarches administratives –
                                  subventions et crédit à la consommation
                                </strong>
                                <br />
                                <strong style="font-weight: 800"
                                  >10.1.- Subventions</strong
                                >
                                - Sauf stipulation contraire indiquée au Devis, la
                                Société s’engage à assister l’acheteur dans les
                                démarches administratives nécessaires afin
                                d’obtenir le certificat d’économie d’énergie (CEE)
                                ainsi que la subvention de l’ANAH (MaPrimeRénov’)
                                sous réserve de la remise par l’Acheteur de
                                l’ensemble de la documentation nécessaire à la
                                demande d’aide formulée entre les mains de l’ANAH
                                ainsi que de la signature de tous documents
                                nécessaires à la délivrance de cette aide. Le
                                Vendeur ne peut être tenu responsable de
                                l’obtention ou non par l’Acheteur de subventions,
                                aides et crédit d’impôts visés par son projet
                                <br />
                                Sauf stipulation contraire indiquée sur le mandat
                                ANAH, L’Acheteur reconnait NOVECOLOGY comme le
                                mandataire pour le versement de la prime ANAH
                                (MaPrimeRénov’). L’Acheteur s’engage à reverser
                                entièrement la prime ANAH à NOVECOLOGY à la fin du
                                chantier et après la signature du procès-verbal de
                                réception de chantier <br />
                                L’aide ANAH (MaPrimeRénov’) est conditionnelle et
                                soumise à la conformité des pièces justificatives
                                et informations déclarées par le bénéficiaire.
                                L’Acheteur est informé qu’en cas de fausse
                                déclaration, de manœuvre frauduleuse ou de
                                changement du projet de travaux subventionné, il
                                s’expose au retrait et reversement de tout ou
                                partie de l’aide. Les services de l’ANAH pourront
                                faire procéder à tout contrôle des engagements et
                                sanctionner l’Acheteur et son mandataire éventuel
                                des manquements constatés <br />
                                Enfin, l’Acheteur est informé que dans le cas où
                                les subventions ou aides dont il pourrait
                                bénéficier viennent en déduction du solde du prix
                                de vente des Produits dont est redevable
                                l’Acheteur ; dans ces conditions, l’Acheteur est
                                informé qu’en cas de refus de la prime ANAH, ou de
                                demande de remboursement de la prime par l’ANAH,
                                le Vendeur se réserve le droit de solliciter
                                auprès de l’Acheteur le paiement d’une somme
                                équivalente à la prime de l’ANAH, qui n’aurait pas
                                été versée, qui aurait été refusée ou qui aurait
                                été annulée et remboursée. Toutefois, il ne s’agit
                                que d’une faculté pour le Vendeur et l’Acheteur
                                s’engage, avec le Vendeur, à faire ses meilleurs
                                efforts pour régulariser la situation et obtenir
                                la prime de l’ANAH lorsque cela est possible.
                                <br />
                                Toutes démarches visant notamment à l’obtention
                                d’un crédit d’impôt sont à la charge exclusive de
                                l’Acheteur, qui a pu, préalablement à la vente,
                                vérifier les critères d’éligibilité, estimer les
                                avantages de l’achat du produit que lui propose le
                                Vendeur , ainsi que les démarches à effectuer pour
                                obtenir le bénéfice de l’avantage fiscal. <br />
                                Pour ce faire, l’Acheteur peut se rendre sur le
                                site internet suivant :
                                https://impots.gouv.fr/portail/particulier/calcul-et-declaration-du-cite.
                                <br />
                                <br>
                                <br>
                                <strong style="font-weight: 800"
                                  >10.2.- Crédit affecté</strong
                                >
                                – Le crédit dont le montant emprunté financera
                                exclusivement l’acquisition des Produits
                                mentionnés sur le devis / la Commande sera
                                considéré comme un crédit affecté. L’Acheteur peut
                                faire appel directement à la banque ou
                                l’établissement de crédit de son choix ou recourir
                                au financement proposé par un établissement
                                financier partenaire du Vendeur. L’offre de
                                financement est destinée à financer uniquement des
                                besoins non professionnels <br />
                                L’Acheteur intéressé par une offre de financement
                                peut contacter le service client du Vendeur avant
                                de passer sa Commande. L’établissement de crédit
                                organisme prêteur reste seul juge de ses décisions
                                en ce qui concerne l’analyse de la solvabilité de
                                l’Acheteur, candidat emprunteur, l’octroi du
                                crédit, leurs conditions financières, les
                                conditions et garanties attachées aux prêts et à
                                leur attribution. Il <br />
                                est rappelé à l’Acheteur
                                <strong style="font-weight: 800"
                                  >qu’un crédit l’engage et doit être remboursé et
                                  qu’il doit vérifier ses capacités de
                                  remboursement avant de s’engager.
                                </strong>
                                <br />
                                Comme dans tout crédit, l’Acheteur bénéficie d'un
                                délai de 14 jours calendaires à partir de la
                                signature du contrat de crédit pour se rétracter.
                                Il doit alors s’adresser à l'établissement de
                                crédit dans les conditions qui seront indiquées
                                dans le contrat de crédit. Aucune demande de
                                prélèvement ne pourra être faite avant
                                l’expiration du délai de rétractation de 14 jours
                                calendaires prévu par l’article L 312-19 du code
                                de la consommation. <br />
                                En cas de vente à crédit, l’organisme de crédit se
                                réservant le droit d’agréer l’emprunteur, la
                                Commande ne devient parfaite qu’à la double
                                condition que (i) l’emprunteur n’ait pas usé de sa
                                faculté de rétractation et que (ii) le prêteur ait
                                fait connaître à l’emprunteur sa décision
                                d’accorder le crédit dans un délai de 7 jours.
                                Pendant un délai de 7 jours à compter de
                                l’acceptation du contrat par l’emprunteur, aucun
                                paiement sous quelque forme que ce soit ne peut
                                être fait par le prêteur à l’emprunteur, ou pour
                                le compte de celui-ci, ni par l’emprunteur au
                                prêteur <br />
                                En cas d’octroi du financement, la date de
                                livraison est susceptible d'être repoussée en
                                raison du délai nécessaire au traitement de la
                                demande de financement. Une fois la demande
                                approuvée par le partenaire financier, le Client
                                en sera informé par tout moyen lui confirmant sa
                                commande et lui annonçant la date de livraison. Si
                                l’Acheteur a recours à un financement, il s’engage
                                à autoriser le Vendeur à conclure avec
                                l’établissement financier une délégation de
                                paiement de manière à ce que l’établissement
                                financier règle directement au Vendeur le prix
                                indiqué sur le Devis. L’établissement financier
                                adresse les fonds directement au Vendeur dès
                                réception du Procès-verbal d’installation et/ou de
                                réception visé à
                                <strong style="font-weight: 800"
                                  >l’article 6 « Réception</strong
                                >
                                », signé par l’Acheteur qui atteste de <br />
                                des prestations de livraison et d’installation des
                                Produits, et qu’il autorise le déblocage des
                                fonds. <br />
                                En cas de refus de la part de l’organisme
                                financier la Commande sera dans ce cas résolue de
                                plein droit, dans les conditions rappelées
                                ciaprès. <br />
                                Tant qu’il n’est pas avisé de l'octroi du crédit
                                par tout document approprié, et tant que le Client
                                emprunteur peut exercer sa faculté de rétractation
                                de l’article L312-19 du code de la consommation,
                                NOVECOLOGY n'est pas tenu d'accomplir son
                                obligation de livraison ou de fourniture <br />
                                <span style="text-decoration: underline"
                                  >Résolution de plein droit du contrat
                                  conclu</span
                                >. Le contrat de vente ou de prestation de
                                services conclu avec un crédit affecté est résolu
                                de plein droit, sans indemnité (1) Si le prêteur
                                n'a pas, dans un délai de sept (7) jours à compter
                                de l'acceptation du contrat de crédit par
                                l'emprunteur, informé le vendeur de l'attribution
                                du crédit ou (2) si l'emprunteur a exercé son
                                droit de rétractation dans le délai prévu à
                                l'article L. 312-19. Toutefois, lorsque par une
                                demande expresse rédigée, datée et signée de sa
                                main même, l'acheteur sollicite la livraison ou la
                                fourniture immédiate du bien ou de la prestation
                                de services, le délai de rétractation ouvert à
                                l'emprunteur par l'article L. 312-19 du Code de la
                                consommation expire à la date de la livraison ou
                                de la fourniture, sans pouvoir ni excéder quatorze
                                (14) jours ni être inférieur à <br />] trois (3)
                                jours. Toute livraison ou fourniture anticipée est
                                à la charge du vendeur qui en supporte tous les
                                frais et risques. <br />
                                Le contrat n'est pas résolu si, avant l'expiration
                                des délais susmentionnés, l'acquéreur paie
                                comptant.
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table>
                            <tr>
                              <td
                                style="
                                  font-size: 7px;
                                  line-height: 10px;
                                  letter-spacing: 0.3px;
                                  text-align: justify;
                                "
                              >
                                <strong style="font-weight: 800"
                                  >ARTICLE 11 : Résolution du contrat
                                </strong>
                                <br />
                                Le contrat peut être résolu, par lettre
                                recommandée avec demande d'avis de réception ou
                                par un écrit sur un autre support durable, dans
                                les hypothèses suivantes : <br />
                                <span style="text-decoration: underline"
                                  >Par le Vendeur :</span
                                >
                                <br />
                                <ul
                                  style="
                                    margin-left: 13px;
                                    margin-top: 5px;
                                    line-height: 12px;
                                  "
                                >
                                  <li>
                                    En cas de non-paiement du prix (ou du solde du
                                    prix) au moment de la livraison
                                  </li>
                                  <li>
                                    En cas de refus de l’Acheteur de réceptionner
                                    la livraison
                                  </li>
                                </ul>
                                L'acompte versé ou les acomptes versés restent
                                acquis au Vendeur à titre d'indemnité, notamment
                                pour paiement de l'ensemble des démarches
                                administratives et financières effectuées au nom
                                et pour le compte de l’Acheteur pour la commande,
                                la livraison et l'installation des Produits
                                commandés <br />
                                La résolution sera acquise de plein droit et sans
                                formalités judiciaires <br />
                                <span style="text-decoration: underline"
                                  >Par l’Acheteur :</span
                                >
                                <br />
                                <ul>
                                  <li>
                                    En cas de retard de livraison : lorsque le
                                    produit commandé n’est pas livré au terme de
                                    ce délai maximum de trois (3) mois suivant la
                                    notification au Vendeur de l’aide de l’ ANAH ,
                                    l’Acheteur, après avoir enjoint sans succès
                                    par lettre recommandée avec accusé de
                                    réception le Vendeur à exécuter son obligation
                                    de livraison dans un délai maximum d’un (1)
                                    mois, résoudre le contrat par lettre
                                    recommandée avec demande d’avis de réception
                                    ou par un écrit sur un autre support durable,
                                    sauf les cas de force majeure au sens de la
                                    jurisprudence
                                  </li>
                                  <li>
                                    En cas de livraison d’un produit non conforme
                                    aux caractéristiques déclarées du Produit ; il
                                    est rappelé que lorsque le Produit est livré à
                                    l’adresse indiquée sur le Devis par un
                                    transporteur, il appartient à l’Acheteur de
                                    vérifier en présence du livreur l’état des
                                    produits livrés et, en cas d’avarie ou de
                                    manquants, d’émettre des réserves directement
                                    sur le bon de livraison ou sur le récépissé de
                                    transport, et éventuellement de refuser le
                                    produit et d’en avertir le Vendeur
                                  </li>
                                  <li>
                                    En cas de hausse du prix qui ne serait pas
                                    justifiée par une modification technique du
                                    produit imposée par les pouvoirs publics.
                                  </li>
                                  <li>
                                    si l’Acheteur exerce son droit de rétractation
                                    dans le délai légal.
                                  </li>
                                </ul>
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table>
                            <tr>
                              <td
                                style="
                                  font-size: 7px;
                                  line-height: 10px;
                                  letter-spacing: 0.3px;
                                  text-align: justify;
                                "
                              >
                                <strong style="font-weight: 800"
                                  >ARTICLE 12 : Clause pénale</strong
                                >
                                <br />
                                Dans tous les cas d’inexécution de ses obligations
                                par l’Acheteur, celui-ci devra, à titre
                                d’indemnité, au Vendeur un montant égal à 50 % du
                                montant de la commande (hors aides et subventions
                                diverses), en plus, le cas échéant, du coût de la
                                désinstallation des matériaux installés. <br />
                                Toute personne dispose d’un droit d’accès, de
                                rectification, de portabilité, d’effacement de ses
                                données personnelles ou une limitation de leur
                                traitement, du droit d’opposition au traitement de
                                ses données pour des motifs légitimes et du droit
                                de retirer son consentement à tout moment. Enfin,
                                chacun dispose du droit d’introduire une
                                réclamation auprès d’une autorité de contrôle et
                                de définir des directives relatives au sort de ses
                                données personnelles après sa mort.
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table style="width: 100%">
                            <tr>
                              <td
                                style="
                                  font-size: 7px;
                                  line-height: 10px;
                                  letter-spacing: 0.3px;
                                  text-align: justify;
                                "
                              >
                                <strong style="font-weight: 800"
                                  >ARTICLE 18 : Droit applicable / Litiges</strong
                                >
                                <br />
                                Les présentes Conditions Générales de Vente et le
                                contrat sont soumis à la loi française. Le
                                tribunal compétent en cas de litige sera celui du
                                lieu de domicile du défendeur ou, au choix du
                                demandeur, du lieu de livraison effective du
                                Produit ou de la signature du contrat.
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table style="width: 100%">
                            <tr>
                              <td style="font-size: 9px; text-align: center">
                                <strong
                                  style="
                                    font-weight: 800;
                                    text-decoration: underline;
                                  "
                                  >EXTRAITS DES TEXTES LEGAUX</strong
                                >
                              </td>
                            </tr>
                            <tr>
                              <td
                                style="
                                  font-size: 7px;
                                  line-height: 10px;
                                  letter-spacing: 0.3px;
                                  text-align: justify;
                                "
                              >
                                <strong style="font-weight: 800; font-size: 9px"
                                  >Article L. 221-8 Code de la consommation
                                </strong>
                                <br />
                                Dans le cas d'un contrat conclu hors
                                établissement, le professionnel fournit au
                                consommateur, sur papier ou, sous réserve de
                                l'accord du consommateur, sur un autre support
                                durable, les informations prévues à l'article L.
                                221-5. <br />
                                Ces informations sont rédigées de manière lisible
                                et compréhensible.
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table>
                            <tr>
                              <td
                                style="
                                  font-size: 7px;
                                  line-height: 10px;
                                  letter-spacing: 0.3px;
                                  text-align: justify;
                                "
                              >
                                <strong style="font-weight: 800"
                                  >Article L. 221-9 Code de la
                                  consommation</strong
                                >
                                <br />
                                Le professionnel fournit au consommateur un
                                exemplaire daté du contrat conclu hors
                                établissement, sur papier signé par les parties
                                ou, avec l'accord du consommateur, sur un autre
                                support durable, confirmant l'engagement exprès
                                des parties <br />
                                Ce contrat comprend toutes les informations
                                prévues à l'article L. 221-5 <br />
                                Le contrat mentionne, le cas échéant, l'accord
                                exprès du consommateur pour la fourniture d'un
                                contenu numérique indépendant de tout support
                                matériel avant l'expiration du délai de
                                rétractation et, dans cette hypothèse, le
                                renoncement de ce dernier à l'exercice de son
                                droit de rétractation <br />
                                Le contrat est accompagné du formulaire type de
                                rétractation mentionné au 2° de l'article L.
                                221-5.
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table>
                            <tr>
                              <td
                                style="
                                  font-size: 7px;
                                  line-height: 10px;
                                  letter-spacing: 0.3px;
                                  text-align: justify;
                                "
                              >
                                <strong style="font-weight: 800"
                                  >Article L. 221-10 Code de la consommation
                                </strong>
                                <br />
                                Le professionnel ne peut recevoir aucun paiement
                                ou aucune contrepartie, sous quelque forme que ce
                                soit, de la part du consommateur avant
                                l'expiration d'un délai de sept jours à compter de
                                la conclusion du contrat hors établissement.
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table>
                            <td
                              style="
                                font-size: 7px;
                                line-height: 10px;
                                letter-spacing: 0.3px;
                                text-align: justify;
                              "
                            >
                              <strong style="font-weight: 800"
                                >Article L. 221-18 Code de la consommation
                              </strong>
                              <br />
                              Le consommateur dispose d'un délai de quatorze jours
                              pour exercer son droit de rétractation d'un contrat
                              conclu à distance, à la suite d'un démarchage
                              téléphonique ou hors établissement, sans avoir à
                              motiver sa décision ni à supporter d'autres coûts
                              que ceux prévus aux articles L. 221-23 à L. 221-25.
                              <br />
                              Le délai mentionné au premier alinéa court à compter
                              du jour :
                              <br />
                              1° De la conclusion du contrat, pour les contrats de
                              prestation de services et ceux mentionnés à
                              l'article L. 221-4 ; <br />
                              2° De la réception du bien par le consommateur ou un
                              tiers, autre que le transporteur, désigné par lui,
                              pour les contrats de vente de biens. Pour les
                              contrats conclus hors établissement, le consommateur
                              peut exercer son droit de rétractation à compter de
                              la conclusion du contrat <br />
                              Dans le cas d'une commande portant sur plusieurs
                              biens livrés séparément ou dans le cas d'une
                              commande d'un bien composé de lots ou de pièces
                              multiples dont la livraison est échelonnée sur une
                              période définie, le délai court à compter de la
                              réception du dernier bien ou lot ou de la dernière
                              pièce <br />
                              Pour les contrats prévoyant la livraison régulière
                              de biens pendant une période définie, le délai court
                              à compter de la réception du premier bien.
                            </td>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table>
                            <tr>
                              <td
                                style="
                                  font-size: 7px;
                                  line-height: 10px;
                                  letter-spacing: 0.3px;
                                  text-align: justify;
                                "
                              >
                                <strong style="font-weight: 800"
                                  >Article L. 217-4 Code de la
                                  consommation</strong
                                >
                                <br />
                                Le vendeur est tenu de livrer un bien conforme au
                                contrat et répond des défauts de conformité
                                existant lors de la délivrance. Il répond
                                également des défauts de conformité résultant de
                                l'emballage, des instructions de montage ou de
                                l'installation lorsque celle-ci a été mise à sa
                                charge par le contrat ou a été réalisée sous sa
                                responsabilité.
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table>
                            <tr>
                              <td
                                style="
                                  font-size: 7px;
                                  line-height: 10px;
                                  letter-spacing: 0.3px;
                                  text-align: justify;
                                "
                              >
                                <strong style="font: weight 800"
                                  >Article L. 217-5 Code de la
                                  consommation</strong
                                >
                                <br />
                                Le bien est conforme au contrat : <br />
                                S'il est propre à l'usage habituellement attendu
                                d'un bien semblable et, le cas échéant : <br />
                                s'il correspond à la description donnée par le
                                vendeur et possède les qualités que celui-ci a
                                présentées à l'acheteur sous forme d'échantillon
                                ou de modèle ; <br />
                                - s'il présente les qualités qu'un acheteur peut
                                légitimement attendre eu égard aux déclarations
                                publiques faites par le vendeur, par le producteur
                                ou par son représentant, notamment dans la
                                publicité ou l'étiquetage ; <br />
                                Ou s'il présente les caractéristiques définies
                                d'un commun accord par les parties ou est propre à
                                tout usage spécial recherché par l'acheteur, porté
                                à la connaissance du vendeur et que ce dernier a
                                accepté <br />
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table>
                            <tr>
                              <td
                                style="
                                  font-size: 7px;
                                  line-height: 10px;
                                  letter-spacing: 0.3px;
                                  text-align: justify;
                                "
                              >
                                <strong style="font-weight: 800"
                                  >Article L217-12 Code de la consommation</strong
                                >
                                <br />
                                L'action résultant du défaut de conformité se
                                prescrit par deux ans à compter de la délivrance
                                du bien.
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table>
                            <tr>
                              <td
                                style="
                                  font-size: 7px;
                                  line-height: 10px;
                                  letter-spacing: 0.3px;
                                  text-align: justify;
                                "
                              >
                                <strong style="font-weight: 800"
                                  >Article L. 217-16 Code de la Consommation :
                                </strong>
                                <br />
                                Lorsque l'acheteur demande au vendeur, pendant le
                                cours de la garantie commerciale qui lui a été
                                consentie lors de l'acquisition ou de la
                                réparation d'un bien meuble, une remise en état
                                couverte par la garantie, toute période
                                d'immobilisation d'au moins sept jours vient
                                s'ajouter à la durée de la garantie qui restait à
                                courir. Cette période court à compter de la
                                demande d'intervention de l'acheteur ou de la mise
                                à disposition pour réparation du bien en cause, si
                                cette mise à disposition est postérieure à la
                                demande d'intervention
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table>
                            <tr>
                              <td
                                style="
                                  font-size: 7px;
                                  line-height: 10px;
                                  letter-spacing: 0.3px;
                                  text-align: justify;
                                "
                              >
                                <strong style="font-weight: 800"
                                  >Article 1641 Code civil
                                </strong>
                                <br />
                                Le vendeur est tenu de la garantie à raison des
                                défauts cachés de la chose vendue qui la rendent
                                impropre à l'usage auquel on la destine, ou qui
                                diminuent tellement cet usage, que l'acheteur ne
                                l'aurait pas acquise, ou n'en aurait donné qu'un
                                moindre prix, s'il les avait connus.
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table>
                            <tr>
                              <td
                                style="
                                  font-size: 7px;
                                  line-height: 10px;
                                  letter-spacing: 0.3px;
                                  text-align: justify;
                                "
                              >
                                <strong style="font-weight: 800"
                                  >Article 1648 alinéa 1er Code civil</strong
                                >
                                <br />
                                L'action résultant des vices rédhibitoires doit
                                être intentée par l'acquéreur dans un délai de
                                deux ans à compter de la découverte du vice.
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table>
                            <tr>
                              <td
                                style="
                                  font-size: 7px;
                                  line-height: 10px;
                                  letter-spacing: 0.3px;
                                  text-align: justify;
                                "
                              >
                                <strong style="font-weight: 800"
                                  >Article L312-47 du code de la consommation
                                </strong>
                                <br />
                                Tant que le prêteur ne l'a pas avisé de l'octroi
                                du crédit, et tant que l'emprunteur peut exercer
                                sa faculté de rétractation, le vendeur n'est pas
                                tenu d'accomplir son obligation de livraison ou de
                                fourniture. Toutefois, lorsque par une demande
                                expresse rédigée, datée et signée de sa main même,
                                l'acheteur sollicite la livraison ou la fourniture
                                immédiate du bien ou de la prestation de services,
                                le délai de rétractation ouvert à l'emprunteur par
                                l'article L. 312-19 expire à la date de la
                                livraison ou de la fourniture, sans pouvoir ni
                                excéder quatorze jours ni être inférieur à trois
                                jours <br />
                                Toute livraison ou fourniture anticipée est à la
                                charge du vendeur qui en supporte tous les frais
                                et risques.
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table>
                            <tr>
                              <td
                                style="
                                  font-size: 7px;
                                  line-height: 10px;
                                  letter-spacing: 0.3px;
                                  text-align: justify;
                                "
                              >
                                <strong style="font-weight: 800"
                                  >Article L312-52 du code de la consommation
                                  :</strong
                                >
                                <br />
                                Le contrat de vente ou de prestation de services
                                est résolu de plein droit, sans indemnité : <br />
                                1° Si le prêteur n'a pas, dans un délai de sept
                                jours à compter de l'acceptation du contrat de
                                crédit par l'emprunteur, informé le vendeur de
                                l'attribution du crédit ; <br />
                                2° Ou si l'emprunteur a exercé son droit de
                                rétractation dans le délai prévu à l'article L.
                                312-19. <br />
                                Toutefois, lorsque l'emprunteur, par une demande
                                expresse, sollicite la livraison ou la fourniture
                                immédiate du bien ou de la prestation de services,
                                l'exercice du droit de rétractation du contrat de
                                crédit n'emporte résolution de plein droit du
                                contrat de vente ou de prestation de services que
                                s'il intervient dans un délai de trois jours à
                                compter de l'acceptation du contrat de crédit par
                                l'emprunteur. <br />
                                Le contrat n'est pas résolu si, avant l'expiration
                                des délais mentionnés au présent article,
                                l'acquéreur paie comptant.
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table>
                            <tr>
                              <td
                                style="
                                  font-size: 7px;
                                  line-height: 10px;
                                  letter-spacing: 0.3px;
                                  text-align: justify;
                                "
                              >
                                <strong style="font-weight: 800"
                                  >Article L312-53 du code de la consommation
                                  :</strong
                                >
                                <br />
                                Dans les cas de résolution du contrat de vente ou
                                de prestations de services prévus à l'article L.
                                312-52, le vendeur ou le prestataire de services
                                rembourse, sur simple demande, toute somme que
                                l'acheteur aurait versée d'avance sur le prix
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table>
                            <tr>
                              <td
                                style="
                                  font-size: 7px;
                                  line-height: 10px;
                                  letter-spacing: 0.3px;
                                  text-align: justify;
                                "
                              >
                                <strong style="font-weight: 800"
                                  >Article L341-10 du code de la
                                  consommation:</strong
                                >
                                <br />
                                Dans les cas de résolution du contrat de vente ou
                                de prestations de services prévus à l'article L.
                                312-53, à compter du huitième jour suivant la
                                demande de remboursement de toute somme versée
                                d'avance par l'acheteur, cette somme est
                                productive d'intérêts, de plein droit, au taux de
                                l'intérêt légal majoré de moitié.
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table>
                            <tr>
                              <td
                                style="
                                  font-size: 7px;
                                  line-height: 10px;
                                  letter-spacing: 0.3px;
                                  text-align: justify;
                                "
                              >
                                <strong style="font-weight: 800"
                                  >Article L312-49 du code de la consommation
                                  :</strong
                                >
                                <br />
                                NOVECOLOGY doit conserver une copie du contrat de
                                crédit et la présente sur leur demande aux agents
                                chargés du contrôle.
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
            </td>
          </tr>

          <tr>
            <td>
              <table style="width: 100%" cellspacing="0" cellpadding="0">
                <tr>
                  <td
                    style="
                      font-size: 9px;
                      background-color: #d9d9d9;
                      border-spacing: 25px;
                      text-align: center;
                      padding: 5px 0;
                      border: 1px solid #000000;
                    "
                  >
                    <strong>BORDEREAU DE RETRACTATION</strong>
                  </td>
                </tr>
                <tr>
                  <td
                    style="
                      border: 1px solid #000000;
                      font-size: 7px;
                      line-height: 10px;
                      letter-spacing: 0.3px;
                      text-align: justify;
                      padding: 2px 5px;
                    "
                  >
                    <table style="width: 100%">
                      <tr>
                        <td>
                          <table>
                            <tr>
                              <td>
                                Le consommateur dispose d’un délai de quatorze
                                (14) jours à compter soit de leur réception pour
                                les équipements, et si plusieurs produits sont
                                commandés dans une seule Commande, au moment de la
                                réception du dernier bien commandé, soit de la
                                validation de la commande pour les prestations,
                                pour exercer son droit de rétraction d’un contrat
                                conclu à distance ou hors établissement, sans
                                avoir à motiver sa décision ni à supporter
                                d’autres coûts que ceux prévus aux articles
                                L.221-18 à L.221-29 du Code de la consommation
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table style="width: 100%">
                            <tr>
                              <td style="width: 50%">
                                Numéro de bon de commande / devis :
                              </td>
                              <td>
                                Je vous notifie par la présente ma rétractation du
                                devis portant sur la vente du bien ci-dessous :
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table>
                            <tr>
                              <td>
                                Je vous notifie par la présente ma rétractation du
                                devis portant sur la vente du bien ci-dessous :
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table style="width: 100%">
                            <tr>
                              <td>Commande reçue le ……………………………………..….</td>
                              <td>Nom du consommateur ……………………………………..….</td>
                              <td>Adresse du consommateur ……………………………………..….</td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table>
                            <tr>
                              <td style="text-decoration: underline">
                                Effets de la rétractation
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table>
                            <tr>
                              <td>
                                En cas de rétractation de votre part du présent
                                contrat, nous vous rembourserons tous les
                                paiements reçus de vous, y compris les frais de
                                livraison (à l'exception des frais supplémentaires
                                découlant du fait que vous avez choisi, le cas
                                échéant, un mode de livraison autre que le mode
                                moins coûteux de livraison standard proposé par
                                nous) sans retard excessif et, en tout état de
                                cause, au plus tard quatorze jours à compter du
                                jour où nous sommes informés de votre décision de
                                rétractation du présent contrat. Nous procéderons
                                au remboursement en utilisant le même moyen de
                                paiement que celui que vous aurez utilisé pour la
                                transaction initiale, sauf si vous convenez
                                expressément d'un moyen différent ; en tout état
                                de cause, ce remboursement n'occasionnera pas de
                                frais pour vous. Nous récupérerons le bien.
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table>
                            <tr>
                              <td>Signature du consommateur</td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <!-- <tr>
                        <td>
                          
                        </td>
                      </tr>
                      <tr>
                        
                      </tr>
                      <tr>
                        <td>
                          Je vous notifie par la présente ma rétractation du devis
                          portant sur la vente du bien ci-dessous :
                        </td>
                      </tr>
                      <tr>
                        <td>Commande reçue le ……………………………………..…</td>
                        <td>Nom du consommateur ……………………………………..…</td>
                        <td>Adresse du consommateur ……………………………………..…</td>
                      </tr> -->
                    </table>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
    </div> --}}

    <div class="page" style="page-break-before: always;">
        <table
          cellpadding="0"
          cellspacing="0"
          style="width: 100%; font-family: sans-serif">
          <tr>
            <td>
              <table>
                <tr>
         
                  <td style="width: 50%; vertical-align: baseline">
                    <table style="width: 100%; border-spacing: 25px">
                      <tr>
                        <td>
                          <table style="width: 100%">
                            <tr>
                              <td style="text-align: center; font-size: 8px">
                                CONDITIONS GENERALES DE VENTE NOVECOLOGY
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table>
                            <tr>
                              <td style="font-size: 9px">
                                <strong>PREAMBULE</strong>
                              </td>
                            </tr>
                            <tr>
                              <td
                                style="
                                  font-size: 7px;
                                  text-align: justify;
                                  line-height: 10px;
                                  letter-spacing: 0.3px;
                                "
                              >
                                Les présentes Conditions générales de vente
                                (ci-après les «
                                <strong style="font-weight: 800">CGV</strong> »)
                                sont applicables à la vente hors établissement par
                                la société NOVECOLOGY, Société par actions
                                simplifiée (SAS) - Capital de 10 000 euros - SIRET
                                : 84994780900026 - NAF-APE : 4322B - Numéro TVA FR
                                74 849 947 809 dont le siège social est situé 2
                                RUE DU PRE DES AULNES 77340 PONTAULT-COMBAULT ,
                                représentée par NS Président et ci-après dénommée
                                «
                                <strong style="font-weight: 800"
                                  >la Société</strong
                                >
                                » ou le «
                                <strong style="font-weight: 800">Vendeur</strong>
                                » de produits et installations destinés à
                                favoriser le renouvellement de l’énergie, et
                                notamment les pompes à chaleur, les chaudières à
                                granules, les ballons (ecs) thermodynamiques,
                                ballons thermo-solaire, et isolations extérieures
                                et intérieures et les biens accessoires à ces
                                installations et/ou les prestations commandées
                                (ci-après les «
                                <strong style="font-weight: 800">Produits</strong>
                                ») tels que précisés également en article 2 et sur
                                le Devis au sens de l’article 3.1. ci-après auprès
                                des consommateurs tels que définis par la Loi et
                                la jurisprudence, et notamment toute personne
                                physique ou toute personne morale agissant à titre
                                privé et/ou agissant à des fins qui n’entrent pas
                                dans le cadre de son activité commerciale,
                                industrielle, artisanale ou libérale et disposant
                                de sa pleine capacité (ci-après l’ «
                                <strong style="font-weight: 800">Acheteur</strong>
                                »).
                                <br />
                                Les Produits proposés à la vente sont réservés aux
                                Acheteurs résidant en France métropolitaine et
                                pour des livraisons et installations dans cette
                                même zone géographique. <br />
                                Le vente hors établissement est notamment la vente
                                qui est conclue en la présence physique simultanée
                                du Vendeur et de l’Acheteur, ailleurs que dans
                                l’établissement commercial du Vendeur. <br />
                                Il est ici rappelé que l’article L. 221-10 du Code
                                de la consommation, reproduit intégralement
                                ci-après, dispose qu’avant expiration du délai de
                                réflexion de 7 jours visé ci-après en annexe, le
                                Vendeur ne peut recevoir de l’Acheteur directement
                                ou indirectement, à quelque titre ni sous quelque
                                forme que ce soit, aucun paiement.
                                <br />
                                Toutes les communications, notifications ou mises
                                en demeure prévues aux CGV adressées à la société
                                NOVECOLOGY seront faites par lettre recommandée
                                avec accusé de réception à l’adresse postale
                                suivante : NOVECOLOGY : 2 rue du Pré des Aulnes
                                77340 Pontault Combault, ou par mail à l’adresse
                                e-mail suivante: support@novecology.fr. En outre,
                                sont précisées les coordonnées suivantes : <br />
                                - Service clientèle : 01 87 66 57 30 <br />
                                - Service après-vente : 01 87 66 57 30
                              </td>
                            </tr>
                            <tr style="font-size: 9px">
                              <td><strong>ARTICLE 1 : OBJET DES CGV</strong></td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table>
                            <tr style="font-size: 9px">
                              <td><strong>ARTICLE 1 : OBJET DES CGV</strong></td>
                            </tr>
                            <tr>
                              <td
                                style="
                                  font-size: 7px;
                                  text-align: justify;
                                  line-height: 10px;
                                  letter-spacing: 0.3px;
                                "
                              >
                                <strong style="color: #000000; font-weight: 800"
                                  >1. 1. Documents contractuels</strong
                                >
                                - Les CGV constituent avec le Devis, les documents
                                contractuels opposables aux parties, à l’exclusion
                                de tous <br />
                                <strong style="font-weight: 800"
                                  >1. 2. Acceptation et opposabilité des
                                  CGV</strong
                                >
                                - L’Acheteur déclare avoir pris connaissance des
                                CGV et du Devis avant de passer une Commande, et
                                les accepter sans réserve. En conséquence, le fait
                                de passer Commande implique l’adhésion entière et
                                sans réserve de l’Acheteur à ces CGV. En cas de
                                contradiction entre les présentes CGV et des
                                conditions particulières du contrat qui seront
                                éventuellement émises, ces dernières prévaudront.
                                Toute dérogation à l’une quelconque des CGV doit
                                faire l’objet d’une convention expresse écrite.
                                <br />
                                <strong style="font-weight: 800"
                                  >1. 3. Clauses des CGV</strong
                                >
                                - Si l’une quelconque des stipulations des CGV
                                était annulée, cette nullité n’entraînerait pas la
                                nullité des autres dispositions des documents
                                contractuels qui demeureront en vigueur entre les
                                parties. Le fait pour l’une des Parties de ne pas
                                se prévaloir d’un engagement par l’autre Partie à
                                l’une quelconque des obligations visées par les
                                présentes, ne saurait être interprété pour
                                l’avenir comme une renonciation à l’obligation en
                                cause, toutes les clauses des CGV continuant à
                                produire leurs effets
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table>
                            <tr>
                              <td style="font-size: 9px">
                                <strong>ARTICLE 2 : PRODUITS</strong>
                              </td>
                            </tr>
                            <tr>
                              <td
                                style="
                                  font-size: 7px;
                                  text-align: justify;
                                  line-height: 10px;
                                  letter-spacing: 0.3px;
                                "
                              >
                                <strong style="font-weight: 800"
                                  >2. 1. Caractéristiques</strong
                                >
                                - Les Produits offerts à la vente font chacun
                                l’objet d’un descriptif mentionnant leurs
                                caractéristiques essentielles et le prix des biens
                                et services vendus au sens des articles L. 111-1
                                et L 111-4 du code de la consommation, ainsi que
                                les dates de livraison des Produits qui, par
                                défaut, sont celles prévues aux termes de
                                <strong style="font-weight: 800"
                                  >l’article « 4 – Livraison</strong
                                >
                                ». Les matériaux vendus et les prestations
                                commandées sont identifiés au recto. <br />
                                L’Acheteur a préalablement à sa Commande pris
                                connaissance des caractéristiques essentielles des
                                Produits commandés en consultant les informations
                                précontractuelles qui lui ont été communiquées par
                                le Vendeur. Les photographies et les graphismes
                                figurant sur le catalogue ou le site Internet ne
                                sont donnés qu’à titre indicatif et ne sauraient
                                constituer un engagement contractuel du Vendeur
                                garantissant une similitude parfaite entre le
                                Produit commandé et le Produit représenté. Il est
                                précisé que le Vendeur fournit et installe, ou
                                fait installer par un installateur agréé par lui,
                                les Produits vendus. Il peut également assister
                                l’Acheteur dans les démarches administratives
                                inhérentes à cette installation comme précisé à
                                <strong style="font-weight: 800"
                                  >l’article 10 – Démarches
                                  administratives</strong
                                >. Ces prestations, définies le cas échéant dans
                                le Devis ou des conditions particulières, excluent
                                la maintenance et l’entretien du Produit installé.
                                Le Vendeur peut actualiser, améliorer ses fiches
                                Produits ou retirer de la vente certains Produits.
                                <br />
                                <strong style="font-weight: 800"
                                  >2. 2. Disponibilité des Produits</strong
                                >
                                - Les Produits sont vendus, livrés et installés
                                dans la limite des stocks disponibles. En cas
                                d’indisponibilité du Produit commandé, le Vendeur
                                en informe immédiatement l’Acheteur et peut lui
                                proposer un produit d’une qualité et d’un prix
                                équivalent. En cas de désaccord de l’Acheteur et
                                si le Vendeur avait perçu des sommes avant
                                l’installation, il procède au remboursement des
                                sommes versées dans un délai de 45 jours maximum à
                                compter du refus de l’Acheteur. En dehors du
                                remboursement du prix du produit indisponible, le
                                Vendeur n’est tenu à aucune indemnité
                                d’annulation.
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table>
                            <tr>
                              <td style="font-size: 9px">
                                <strong>ARTICLE 3 : DEVIS ET COMMANDES</strong>
                              </td>
                            </tr>
                            <tr>
                              <td
                                style="
                                  font-size: 7px;
                                  text-align: justify;
                                  line-height: 10px;
                                  letter-spacing: 0.3px;
                                "
                              >
                                <strong style="font-weight: 800"
                                  >3. 1. Devis</strong
                                >
                                - Tout devis émis par le Vendeur (le «
                                <strong style="font-weight: 800">Devis</strong> »)
                                n’est valable que soixante (60) jours à compter de
                                sa date d’émission. Au-delà de ce délai, le
                                Vendeur ne pourra être lié que sur acceptation
                                expresse de sa part. A défaut, un nouveau Devis
                                sera adressé à l’Acheteur.
                                <br />
                               
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                    </table>
                  </td>

               
                  <td style="width: 50%; vertical-align: baseline">
                    <table style="width: 100%; border-spacing: 25px">
                      <tr>
                        <td style="vertical-align: baseline">
                          <table>
                            <tr>
                              <td
                                style="
                                  vertical-align: baseline;
                                  font-size: 7px;
                                  line-height: 10px;
                                  letter-spacing: 0.3px;
                                  text-align: justify;
                                "
                              >
                                La responsabilité de l’Acheteur, en cas de
                                rétractation après utilisation du ou des Produits,
                                est engagée à l’égard de la dépréciation du ou des
                                Produits résultant de manipulations autres que
                                celles nécessaires pour établir la nature, les
                                caractéristiques et le bon fonctionnement de ce ou
                                ces Produits. Enfin, le Vendeur pourra récupérer
                                lui-même le Produit La Société peut effectuer le
                                remboursement du produit en différé jusqu’à ce
                                qu’elle ait reçue l’objet du devis ou jusqu’à que
                                l’Adhérent ait fourni une preuve de l’expédition
                                du Produit
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table>
                            <tr>
                              <td
                                style="
                                  font-size: 7px;
                                  line-height: 10px;
                                  letter-spacing: 0.3px;
                                  text-align: justify;
                                "
                              >
                                <strong style="font-weight: 800"
                                  >7.4. Installation des Produits</strong
                                >
                                – Le Vendeur attire l’attention de l’Acheteur sur
                                le fait qu’aucune installation des Produits ne
                                sera effectuée avant l’expiration du droit de
                                rétractation dont il dispose. Par exception à ce
                                qui précède et conformément à l’article L 221-25
                                du Code de la Consommation, et si l’Acheteur en
                                fait la demande expresse et écrite, le Vendeur
                                pourra procéder à l’installation des Produits
                                avant l’expiration du délai de rétractation mais
                                après le délai de sept (7) jours prévus à
                                l’article 8. Dans cette hypothèse, l’Acheteur qui
                                exercerait postérieurement à l’installation des
                                Produits son droit de rétractation sera tenu au
                                paiement d’un montant correspondant au service
                                fourni jusqu’à la communication de sa décision de
                                se rétracter ; ce montant est proportionné au prix
                                total de la prestation convenue. <br />
                                Enfin, le Vendeur attire également l’attention de
                                l’Acheteur sur le fait qu’en cas de demande
                                expresse et écrite d’installation des Produits
                                avant l’expiration du droit de rétractation, il ne
                                pourra plus, conformément aux dispositions de
                                l’article L221-28 du Code de la Consommation,
                                l’exercer : <br />
                                - Pour les services pleinement exécutés avant la
                                fin du délai de rétractation, <br />
                                - Pour les Produits qui auraient été, du fait de
                                leur installation, confectionnés selon les
                                spécifications de l’Acheteur ou nettement
                                personnalisés telles qu’une découpe du Produit par
                                exemple.
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table>
                            <tr>
                              <td
                                style="
                                  font-size: 7px;
                                  line-height: 10px;
                                  letter-spacing: 0.3px;
                                  text-align: justify;
                                "
                              >
                                <strong style="font-weight: 800"
                                  >ARTICLE 8 : PRIX</strong
                                >
                                <br />
                                Les prix de vente sont indiqués, pour chacun des
                                Produits, en euros toutes taxes comprises. Les
                                taxes sont appliquées selon la règlementation en
                                vigueur. <br />
                                Le prix de vente du Produit est celui en vigueur
                                au jour de la Commande. <br />
                                Le Vendeur se réserve le droit de modifier ses
                                prix à tout moment, tout en garantissant à
                                l’Adhérent l’application du prix en vigueur au
                                jour de sa Commande <br />
                                L’Acheteur reconnait avoir été informé des modes
                                et conditions de règlement désignés au Devis ou
                                bon de commande. <br />
                                Conformément aux dispositions de l’article L221
                                -10 du Code de la consommation, le Vendeur
                                s’interdit de percevoir quelque paiement ou
                                contrepartie, sous quelque forme que ce soit, de
                                la part de l’Acheteur avant l’expiration d’un
                                délai de sept (7) jours à compter de la conclusion
                                du contrat hors établissement <br />
                                Le règlement peut s’effectuer par chèque ou
                                virement par mandat SEPA. <br />
                                Tout paiement non effectué dans les délais prévus
                                donne droit, après mise en demeure effectuée par
                                courrier recommandé A/R, au paiement d’intérêts de
                                retard calculés au taux de 8%. <br />
                                Le vendeur se réserve le droit, lorsque le prix
                                convenu n’est pas payé à l’échéance, soit de
                                demander l’exécution de la vente, soit de résoudre
                                le contrat par simple lettre recommandée avec
                                demande d’avis de réception
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table>
                            <tr>
                              <td
                                style="
                                  font-size: 7px;
                                  line-height: 10px;
                                  letter-spacing: 0.3px;
                                  text-align: justify;
                                "
                              >
                                <strong style="font-weight: 800"
                                  >ARTICLE 9 : CLAUSE DE RESERVE DE
                                  PROPRIETE</strong
                                >
                                <br />
                                LE TRANSFERT DE PROPRIÉTÉ DU PRODUIT VENDU EST
                                SUBORDONNÉ AU PAIEMENT INTÉGRAL DES SOMMES DUES EN
                                PRINCIPAL, FRAIS ET ACCESSOIRES À LA SOCIETE
                                NOVECOLOGY MEME EN CAS D’OCTROI DE DÉLAI DE
                                PAIEMENT <br />
                                LES DISPOSITIONS CI-DESSUS NE FONT PAS OBSTACLE AU
                                TRANSFERT A L’ACHETEUR, DES RISQUES DE PERTE OU
                                D’ENDOMMAGEMENT DU PRODUIT SOUMIS À RÉSERVE DE
                                PROPRIÉTÉ, A PARTIR DU MOMENT OU L’ACHETEUR PREND
                                PHYSIQUEMENT POSSESSION DU PRODUIT, SOIT PAR
                                LUI-MEME SOIT PAS UN TIERS QU’IL A DESIGNE <br />
                                L’ACHETEUR S’ENGAGE, TANT QUE LA PROPRIETE NE LUI
                                EST PAS TRANSFEREE, A PRENDRE TOUTES LES
                                PRECAUTIONS UTILES A LA BONNE CONSERVATION DES
                                PRODUITS.
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table>
                            <tr>
                              <td
                                style="
                                  font-size: 7px;
                                  line-height: 10px;
                                  letter-spacing: 0.3px;
                                  text-align: justify;
                                "
                              >
                                <strong style="font-weight: 800"
                                  >ARTICLE 10 : Démarches administratives –
                                  subventions et crédit à la consommation
                                </strong>
                                <br />
                                <strong style="font-weight: 800"
                                  >10.1.- Subventions</strong
                                >
                                - Sauf stipulation contraire indiquée au Devis, la
                                Société s’engage à assister l’acheteur dans les
                                démarches administratives nécessaires afin
                                d’obtenir le certificat d’économie d’énergie (CEE)
                                ainsi que la subvention de l’ANAH (MaPrimeRénov’)
                                sous réserve de la remise par l’Acheteur de
                                l’ensemble de la documentation nécessaire à la
                                demande d’aide formulée entre les mains de l’ANAH
                                ainsi que de la signature de tous documents
                                nécessaires à la délivrance de cette aide. Le
                                Vendeur ne peut être tenu responsable de
                                l’obtention ou non par l’Acheteur de subventions,
                                aides et crédit d’impôts visés par son projet
                                <br />
                                Sauf stipulation contraire indiquée sur le mandat
                                ANAH, L’Acheteur reconnait NOVECOLOGY comme le
                                mandataire pour le versement de la prime ANAH
                                (MaPrimeRénov’). L’Acheteur s’engage à reverser
                                entièrement la prime ANAH à NOVECOLOGY à la fin du
                                chantier et après la signature du procès-verbal de
                                réception de chantier <br />
                                L’aide ANAH (MaPrimeRénov’) est conditionnelle et
                                soumise à la conformité des pièces justificatives
                                et informations déclarées par le bénéficiaire.
                                L’Acheteur est informé qu’en cas de fausse
                                déclaration, de manœuvre frauduleuse ou de
                                changement du projet de travaux subventionné, il
                                s’expose au retrait et reversement de tout ou
                                partie de l’aide. Les services de l’ANAH pourront
                                faire procéder à tout contrôle des engagements et
                                sanctionner l’Acheteur et son mandataire éventuel
                                des manquements constatés <br />
                                Enfin, l’Acheteur est informé que dans le cas où
                                les subventions ou aides dont il pourrait
                                bénéficier viennent en déduction du solde du prix
                                de vente des Produits dont est redevable
                                l’Acheteur ; dans ces conditions, l’Acheteur est
                                informé qu’en cas de refus de la prime ANAH, ou de
                                demande de remboursement de la prime par l’ANAH,
                                le Vendeur se réserve le droit de solliciter
                                auprès de l’Acheteur le paiement d’une somme
                                équivalente à la prime de l’ANAH, qui n’aurait pas
                                été versée, qui aurait été refusée ou qui aurait
                                été annulée et remboursée. Toutefois, il ne s’agit
                                que d’une faculté pour le Vendeur et l’Acheteur
                                s’engage, avec le Vendeur, à faire ses meilleurs
                                efforts pour régulariser la situation et obtenir
                                la prime de l’ANAH lorsque cela est possible.
                                <br />
                               
                          </table>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
    </div>

{{--======================================2222222========================================  --}}
     <div class="page" style="page-break-after: always;">
        <table
          cellpadding="0"
          cellspacing="0"
          style="width: 100%; font-family: sans-serif">
          <tr>
            <td>
              <table>
                <tr>
                  <td style="width: 50%; vertical-align: baseline">
                    <table style="width: 100%; border-spacing: 25px">
                      <tr>
                        <td>
                          <table>
                            <tr>
                              <td
                                style="
                                  font-size: 7px;
                                  text-align: justify;
                                  line-height: 10px;
                                  letter-spacing: 0.3px;
                                "
                              >
                              Le Vendeur n’est lié par une Commande que
                              lorsqu’il est en possession d’un Devis émis par
                              ses soins et accepté par l’Acheteur dans le délai
                              de 60 jours, sans surcharge ni rature et signé au
                              recto pour acceptation des conditions
                              particulières, des CGV et reconnaissance par
                              l’Acheteur qu’il a reçu l’ensemble des
                              informations précontractuelles conformément aux
                              dispositions de l’article L111-1 du code de la
                              consommation et notamment les caractéristiques
                              essentielles et le prix des Produits 
                                La signature du Devis dans les conditions
                                précitées emporte Commande de la part de
                                l’Acheteur. <br />
                                Le bénéfice de la Commande est personnel à
                                l’Acheteur et ne peut être cédé sans l’accord du
                                Vendeur. <br />
                                <strong style="font-weight: 800"
                                  >3. 2. Caractère définitif de la
                                  Commande</strong
                                >
                                – L’Acheteur est informé qu’il est engagé par sa
                                Commande sous réserve du droit légal de
                                rétractation détaillée à
                                <strong style="font-weight: 800"
                                  >l’article « 7 – Droit de rétractation »</strong
                                >. <br />
                                Les Commandes étant définitives et irrévocables,
                                sous la condition de la prise en charge par l’ANAH
                                (Agence Nationale pour l’Habitat) dans des
                                conditions précisées au verso, toute demande de
                                modification faite par l’Acheteur est soumise à
                                l’acceptation du Vendeur <br />
                                <strong style="font-weight: 800"
                                  >3. 3. Modification de la Commande</strong
                                >
                                - Toute modification de la Commande par l’Acheteur
                                est soumise à l’acceptation expresse du Vendeur.
                                Le Vendeur se réserve le droit d’apporter au
                                Produit commandé les modifications qui sont liées
                                à l’évolution technique dans les conditions
                                prévues à l’article R. 212-4 dernier alinéa du
                                code de la consommation. <br />
                                <strong style="font-weight: 800"
                                  >3. 4. Refus de la Commande</strong
                                >
                                - Le Vendeur se réserve le droit de refuser toute
                                Commande pour des motifs légitimes et plus
                                particulièrement si les quantités de matériel
                                commandées sont anormalement élevées pour des
                                acheteurs ayant la qualité de consommateurs,
                                lorsqu’il existe un litige avec l’Acheteur
                                concernant le paiement d’une Commande antérieure
                                ou si le site d’installation du Produit choisi par
                                l’Acheteur présente des contre-indications
                                techniques pour l’installation de ce Produit.
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table>
                            <tr>
                              <td style="font-size: 9px">
                                <strong style="font-weight: 800"
                                  >ARTICLE 4 : LIVRAISON
                                </strong>
                              </td>
                            </tr>
                            <tr>
                              <td
                                style="
                                  font-size: 7px;
                                  text-align: justify;
                                  line-height: 10px;
                                  letter-spacing: 0.3px;
                                "
                              >
                                <strong style="font-weight: 800">4.1.</strong> -
                                La livraison s’entend de la remise directe des
                                produits vendus à l’Acheteur à son domicile.
                                <br />
                                Elle emporte transfert à l’Acheteur de la
                                possession physique ou du contrôle du Produit
                                <br />
                                <strong style="font-weight: 800">4.2.</strong> - A
                                compter de la notification par l’Acheteur au
                                Vendeur du montant de la subvention à verser par
                                l’ANAH émanant directement de l’Agence National de
                                l’Habitat, le Vendeur s’engage à livrer les
                                Produits dans un délai maximum de 3 (trois) mois ;
                                il est toutefois rappelé que le délai mentionné
                                lors de la Commande est un délai prévisionnel.
                                <br />
                                <strong style="font-weight: 800">4.3.</strong> -
                                Lorsque le Produit commandé n’est pas livré et/ou
                                la prestation exécutée à la date ou à l’expiration
                                du délai visé ci-dessus et sauf causes de
                                prorogation précisées ci-après à l’article 4.4.,
                                l’Acheteur peut, après avoir enjoint sans succès
                                le Vendeur à exécuter son obligation de livraison
                                dans un délai supplémentaire raisonnable, résoudre
                                la Commande par lettre recommandée avec demande
                                d’avis de réception ou par un écrit sur un autre
                                support durable. <br />
                                <strong style="font-weight: 800">4.4.</strong> -
                                Le délai de livraison peut être prorogé en cas de
                                survenance d’un cas fortuit, d’un cas de force
                                majeure, d’une pandémie ou d’une épidémie donnant
                                lieu à des mesures législatives ou règlementaires
                                restreignant l’activité du Vendeur, de ses
                                fournisseurs ou de son personnel, ou d’une cause
                                légitime de suspension du délai ; la prorogation
                                sera égale au nombre de jours pendant lesquels
                                l’événement considéré fait obstacle à l’exécution
                                de la Commande. Outre les cas visés ci-dessus, le
                                délai de livraison pourra être prorogé en cas
                                d’impossibilité d’accéder dans des conditions
                                normales au site de livraison désigné par
                                l’Acheteur ou encore en cas d’indisponibilité de
                                l’Adhérent à plus de 3 dates proposées pour
                                l’exécution des prestations
                                <br />
                                <strong style="font-weight: 800">4.5.</strong> -
                                Les Produits sont livrés à l’adresse indiquée par
                                l’Acheteur sur le Devis. <br />
                                <strong style="font-weight: 800">4.6.</strong> -
                                La livraison des Produits donne lieu à la
                                signature d’un « bon de livraison ».
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table>
                            <tr>
                              <td style="font-size: 9px">
                                <strong style="font-weight: 800"
                                  >ARTICLE 5 : EXECUTION DES TRAVAUX
                                </strong>
                              </td>
                            </tr>
                            <tr>
                              <td
                                style="
                                  font-size: 7px;
                                  text-align: justify;
                                  line-height: 10px;
                                  letter-spacing: 0.3px;
                                "
                              >
                                L’installation et la mise en service des Produits
                                sont assurées, sous réserve de l’exercice par
                                l’Acheteur de son droit de rétractation tel que
                                précisé à
                                <strong style="font-weight: 800"
                                  >l’article 7</strong
                                >
                                ci-après, concomitamment et exclusivement par le
                                Vendeur ou par toute personne ou société dûment
                                mandatée par ce dernier. Pour la réalisation de
                                ces opérations, l’Acheteur s’engage à laisser
                                libre accès aux locaux sur lesquels l’intervention
                                du Vendeur sera réalisée <br />
                                L’Acheteur s’engage à faciliter l’intervention des
                                personnes en charge de l’installation. A défaut il
                                engage sa responsabilité. En tout état de cause,
                                le Vendeur ne saurait être tenu responsable d’un
                                éventuel retard de livraison ou d’installation dû
                                à un refus d’accès au technicien par l’Acheteur.
                                <br />
                                La durée d’exécution des travaux est variable
                                selon les difficultés propres au chantier. Le
                                Vendeur s’engage à en limiter au maximum la durée
                                <br />
                                L’Acheteur devra prendre toutes mesures utiles
                                pour que les risques nés de l’installation du
                                Produit soient assurés.
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table>
                            <tr>
                              <td style="font-size: 9px">
                                <strong style="font-weight: 800"
                                  >ARTICLE 6 : RECEPTION
                                </strong>
                              </td>
                            </tr>
                            <tr>
                              <td
                                style="
                                  font-size: 7px;
                                  text-align: justify;
                                  line-height: 10px;
                                  letter-spacing: 0.3px;
                                "
                              >
                                Dès que les Produits sont installés conformément
                                aux prévisions contractuelles, l’Acheteur signe le
                                procès-verbal d’installation et/ou de réception.
                                Il appartient à l’Acheteur de vérifier en présence
                                de l’installateur, l’état et le bon fonctionnement
                                des Produits installés et, en cas d’avarie ou de
                                manquants, d’émettre des réserves sur le
                                procès-verbal d’installation et/ou de réception.
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table>
                            <tr>
                              <td style="font-size: 9px">
                                <strong>ARTICLE 7 : DROIT DE RETRACTATION</strong>
                              </td>
                            </tr>
                            <tr>
                              <td
                                style="
                                  font-size: 7px;
                                  text-align: justify;
                                  line-height: 10px;
                                  letter-spacing: 0.3px;
                                "
                              >
                                <strong style="font-weight: 800"
                                  >7.1 Conditions, délais et modalités d’exercice
                                  du droit de rétractation</strong
                                >
                                <br />
                                En application de l’article L 221-18 et suivants
                                du code de la consommation, l’Acheteur dispose
                                d’un délai de rétractation de tout ou partie de sa
                                Commande, sans motif, et qui expire quatorze (14)
                                jours à compter du jour de réception de la
                                commande dans le cas d’un contrat portant
                                fourniture de bien ou à compter de la signature du
                                contrat de vente en cas de prestation de services
                                <br />
                                
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                    </table>
                  </td>


                  <td style="width: 50%; vertical-align: baseline">
                    <table style="width: 100%; border-spacing: 25px">
                      <tr>
                        <td>
                          <table>
                            <tr>
                              <td
                                style="
                                  font-size: 7px;
                                  line-height: 10px;
                                  letter-spacing: 0.3px;
                                  text-align: justify;
                                "
                              >

                              Toutes démarches visant notamment à l’obtention
                                d’un crédit d’impôt sont à la charge exclusive de
                                l’Acheteur, qui a pu, préalablement à la vente,
                                vérifier les critères d’éligibilité, estimer les
                                avantages de l’achat du produit que lui propose le
                                Vendeur , ainsi que les démarches à effectuer pour
                                obtenir le bénéfice de l’avantage fiscal. <br />
                                Pour ce faire, l’Acheteur peut se rendre sur le
                                site internet suivant :
                              
                                https://impots.gouv.fr/portail/particulier/calcul-et-declaration-du-cite.
                                <br />
                                <br>
                                <br>
                                <strong style="font-weight: 800"
                                  >10.2.- Crédit affecté</strong
                                >
                                – Le crédit dont le montant emprunté financera
                                exclusivement l’acquisition des Produits
                                mentionnés sur le devis / la Commande sera
                                considéré comme un crédit affecté. L’Acheteur peut
                                faire appel directement à la banque ou
                                l’établissement de crédit de son choix ou recourir
                                au financement proposé par un établissement
                                financier partenaire du Vendeur. L’offre de
                                financement est destinée à financer uniquement des
                                besoins non professionnels <br />
                                L’Acheteur intéressé par une offre de financement
                                peut contacter le service client du Vendeur avant
                                de passer sa Commande. L’établissement de crédit
                                organisme prêteur reste seul juge de ses décisions
                                en ce qui concerne l’analyse de la solvabilité de
                                l’Acheteur, candidat emprunteur, l’octroi du
                                crédit, leurs conditions financières, les
                                conditions et garanties attachées aux prêts et à
                                leur attribution. Il <br />
                                est rappelé à l’Acheteur
                                <strong style="font-weight: 800"
                                  >qu’un crédit l’engage et doit être remboursé et
                                  qu’il doit vérifier ses capacités de
                                  remboursement avant de s’engager.
                                </strong>
                                <br />
                                Comme dans tout crédit, l’Acheteur bénéficie d'un
                                délai de 14 jours calendaires à partir de la
                                signature du contrat de crédit pour se rétracter.
                                Il doit alors s’adresser à l'établissement de
                                crédit dans les conditions qui seront indiquées
                                dans le contrat de crédit. Aucune demande de
                                prélèvement ne pourra être faite avant
                                l’expiration du délai de rétractation de 14 jours
                                calendaires prévu par l’article L 312-19 du code
                                de la consommation. <br />
                                En cas de vente à crédit, l’organisme de crédit se
                                réservant le droit d’agréer l’emprunteur, la
                                Commande ne devient parfaite qu’à la double
                                condition que (i) l’emprunteur n’ait pas usé de sa
                                faculté de rétractation et que (ii) le prêteur ait
                                fait connaître à l’emprunteur sa décision
                                d’accorder le crédit dans un délai de 7 jours.
                                Pendant un délai de 7 jours à compter de
                                l’acceptation du contrat par l’emprunteur, aucun
                                paiement sous quelque forme que ce soit ne peut
                                être fait par le prêteur à l’emprunteur, ou pour
                                le compte de celui-ci, ni par l’emprunteur au
                                prêteur <br />
                                En cas d’octroi du financement, la date de
                                livraison est susceptible d'être repoussée en
                                raison du délai nécessaire au traitement de la
                                demande de financement. Une fois la demande
                                approuvée par le partenaire financier, le Client
                                en sera informé par tout moyen lui confirmant sa
                                commande et lui annonçant la date de livraison. Si
                                l’Acheteur a recours à un financement, il s’engage
                                à autoriser le Vendeur à conclure avec
                                l’établissement financier une délégation de
                                paiement de manière à ce que l’établissement
                                financier règle directement au Vendeur le prix
                                indiqué sur le Devis. L’établissement financier
                                adresse les fonds directement au Vendeur dès
                                réception du Procès-verbal d’installation et/ou de
                                réception visé à
                                <strong style="font-weight: 800"
                                  >l’article 6 « Réception</strong
                                >
                                », signé par l’Acheteur qui atteste de <br />
                                des prestations de livraison et d’installation des
                                Produits, et qu’il autorise le déblocage des
                                fonds. <br />
                                En cas de refus de la part de l’organisme
                                financier la Commande sera dans ce cas résolue de
                                plein droit, dans les conditions rappelées
                                ciaprès. <br />
                                Tant qu’il n’est pas avisé de l'octroi du crédit
                                par tout document approprié, et tant que le Client
                                emprunteur peut exercer sa faculté de rétractation
                                de l’article L312-19 du code de la consommation,
                                NOVECOLOGY n'est pas tenu d'accomplir son
                                obligation de livraison ou de fourniture <br />
                                <span style="text-decoration: underline"
                                  >Résolution de plein droit du contrat
                                  conclu</span
                                >. Le contrat de vente ou de prestation de
                                services conclu avec un crédit affecté est résolu
                                de plein droit, sans indemnité (1) Si le prêteur
                                n'a pas, dans un délai de sept (7) jours à compter
                                de l'acceptation du contrat de crédit par
                                l'emprunteur, informé le vendeur de l'attribution
                                du crédit ou (2) si l'emprunteur a exercé son
                                droit de rétractation dans le délai prévu à
                                l'article L. 312-19. Toutefois, lorsque par une
                                demande expresse rédigée, datée et signée de sa
                                main même, l'acheteur sollicite la livraison ou la
                                fourniture immédiate du bien ou de la prestation
                                de services, le délai de rétractation ouvert à
                                l'emprunteur par l'article L. 312-19 du Code de la
                                consommation expire à la date de la livraison ou
                                de la fourniture, sans pouvoir ni excéder quatorze
                                (14) jours ni être inférieur à <br />] trois (3)
                                jours. Toute livraison ou fourniture anticipée est
                                à la charge du vendeur qui en supporte tous les
                                frais et risques. <br />
                                Le contrat n'est pas résolu si, avant l'expiration
                                des délais susmentionnés, l'acquéreur paie
                                comptant.
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table>
                            <tr>
                              <td
                                style="
                                  font-size: 7px;
                                  line-height: 10px;
                                  letter-spacing: 0.3px;
                                  text-align: justify;
                                "
                              >
                                <strong style="font-weight: 800"
                                  >ARTICLE 11 : Résolution du contrat
                                </strong>
                                <br />
                                Le contrat peut être résolu, par lettre
                                recommandée avec demande d'avis de réception ou
                                par un écrit sur un autre support durable, dans
                                les hypothèses suivantes : <br />
                                <span style="text-decoration: underline"
                                  >Par le Vendeur :</span
                                >
                                <br />
                                <ul
                                  style="
                                    margin-left: 13px;
                                    margin-top: 5px;
                                    line-height: 12px;
                                  "
                                >
                                  <li>
                                    En cas de non-paiement du prix (ou du solde du
                                    prix) au moment de la livraison
                                  </li>
                                  <li>
                                    En cas de refus de l’Acheteur de réceptionner
                                    la livraison
                                  </li>
                                </ul>
                                L'acompte versé ou les acomptes versés restent
                                acquis au Vendeur à titre d'indemnité, notamment
                                pour paiement de l'ensemble des démarches
                                administratives et financières effectuées au nom
                                et pour le compte de l’Acheteur pour la commande,
                                la livraison et l'installation des Produits
                                commandés <br />
                                La résolution sera acquise de plein droit et sans
                                formalités judiciaires <br />
                                <span style="text-decoration: underline"
                                  >Par l’Acheteur :</span
                                >
                                <br />
                                <ul>
                                  <li>
                                    En cas de retard de livraison : lorsque le
                                    produit commandé n’est pas livré au terme de
                                    ce délai maximum de trois (3) mois suivant la
                                    notification au Vendeur de l’aide de l’ ANAH ,
                                    l’Acheteur, après avoir enjoint sans succès
                                    par lettre recommandée avec accusé de
                                    réception le Vendeur à exécuter son obligation
                                    de livraison dans un délai maximum d’un (1)
                                    mois, résoudre le contrat par lettre
                                    recommandée avec demande d’avis de réception
                                    ou par un écrit sur un autre support durable,
                                    sauf les cas de force majeure au sens de la
                                    jurisprudence
                                  </li>
                                  <li>
                                    En cas de livraison d’un produit non conforme
                                    aux caractéristiques déclarées du Produit ; il
                                    est rappelé que lorsque le Produit est livré à
                                    l’adresse indiquée sur le Devis par un
                                    transporteur, il appartient à l’Acheteur de
                                    vérifier en présence du livreur l’état des
                                    produits livrés et, en cas d’avarie ou de
                                    manquants, d’émettre des réserves directement
                                    sur le bon de livraison ou sur le récépissé de
                                    transport, et éventuellement de refuser le
                                    produit et d’en avertir le Vendeur
                                  </li>
                                  <li>
                                    En cas de hausse du prix qui ne serait pas
                                    justifiée par une modification technique du
                                    produit imposée par les pouvoirs publics.
                                  </li>
                                  <li>
                                    si l’Acheteur exerce son droit de rétractation
                                    dans le délai légal.
                                  </li>
                                </ul>
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                     
                    </table>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
    </div>


    {{--====================================333333333============================= --}}

    <div class="page" style="page-break-after: always;">
        <table
          cellpadding="0"
          cellspacing="0"
          style="width: 100%; font-family: sans-serif">
          <tr>
            <td>
              <table>
                <tr>
                  <td style="width: 50%; vertical-align: baseline">
                    <table style="width: 100%; border-spacing: 25px">
                      <tr>
                        <td
                          style="
                            font-size: 7px;
                            text-align: justify;
                            line-height: 10px;
                            letter-spacing: 0.3px;
                          "
                        >
                        Conformément à l’article L.221 -28 du Code de la
                        consommation, ce délai de rétractation n’est pas
                        applicable notamment pour l’achat de produits
                        confectionnés selon les spécifications du
                        consommateur ou nettement personnalisés <br />
                        Le droit de rétractation se fait à la charge de
                        l’Acheteur suivant les modalités ex- posées
                        ci-dessous.
                        <br />
                        L’Acheteur peut se rétracter dans le délai légal
                        sans avoir à donner de motif et sans frais.
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table>
                            <tr>
                              <td
                                style="
                                  font-size: 7px;
                                  text-align: justify;
                                  line-height: 10px;
                                  letter-spacing: 0.3px;
                                "
                              >
                              <strong style="font-weight: 800"
                                >7.2 Modalités d’exercice du droit de
                                rétractation</strong
                              > <br>
                                Pour exercer son droit de rétractation, l’Acheteur
                                devra notifier au Vendeur sa décision de se
                                rétracter du présent contrat au moyen d’une
                                déclaration claire et dénuée d’ambiguïté à
                                l’adresse suivante et ce dans les quatorze (14)
                                jours à compter du jour de réception de la
                                commande dans le cas d’un contrat portant
                                fourniture de bien ou à compter de la signature du
                                contrat de vente en cas de prestation de services
                                par voie postale (par courrier recommandé A/R) :
                                <span style="text-decoration: underline"
                                  >NOVECOLOGY 2 RUE DU PRE DES AULNES 77340
                                  PONTAULT-COMBAULT</span
                                >
                                <br />
                                S’il le souhaite, l’Acheteur peut également
                                utiliser le modèle de formulaire de rétractation
                                disponible en annexe des présentes conditions
                                générales de vente.
                                <br />
                                <strong style="font-weight: 800"
                                  >7.3 Effets de la rétractation</strong
                                >
                                <br />
                                L’exercice du droit de rétractation met fin à
                                l’obligation des parties d’exécuter le contrat.
                                <br />
                                Ainsi, lorsque l’Adhérents exerce son droit de
                                rétractation dans le délai légal, la Société
                                s’engage à lui rembourser le montant du prix perçu
                                dans un délai de 14 (quatorze) jours à compter de
                                la réception du formulaire de rétractation. Ce
                                remboursement sera effectué en utilisant le même
                                moyen de paiement que celui que l’Acheteur a
                                choisi pour la transaction initiale, sauf si
                                l’Acheteur convient expressément d’un moyen
                                différent.
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table>
                            <tr>
                              <td style="font-size: 9px">
                                <strong style="font-weight: 800"
                                  >ARTICLE 13 : Clause de dédit
                                </strong>
                              </td>
                            </tr>
                            <tr>
                              <td
                                style="
                                  font-size: 7px;
                                  text-align: justify;
                                  line-height: 10px;
                                  letter-spacing: 0.3px;
                                "
                              >
                                L’Acheteur s’engage à payer en cas d’annulation de
                                sa commande au-delà du délai légal de
                                rétractation, un montant égal à 50% du prix TTC du
                                devis (hors aides) à titre d’indemnité pour le
                                Vendeur qui aurait déjà tout mis en œuvre pour
                                répondre de cette commande
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table>
                            <tr>
                              <td style="font-size: 9px">
                                <strong
                                  >ARTICLE 14 : GARANTIE LÉGALE DE CONFORMITÉ ET
                                  GARANTIE DES VICES CACHÉS (GARANTIES
                                  LÉGALES)</strong
                                >
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table>
                            <tr>
                              <td
                                style="
                                  font-size: 7px;
                                  text-align: justify;
                                  line-height: 10px;
                                  letter-spacing: 0.3px;
                                  border: 1px solid #000000;
                                  padding: 3px 10px;
                                "
                              >
                                Lorsqu’il agit en garantie légale de conformité,
                                le consommateur bénéficie d’un délai de deux ans à
                                compter de la délivrance du bien pour agir ; il
                                peut choisir entre la réparation ou le
                                remplacement du bien, sous réserve des conditions
                                de coût prévues par l’article L211-9 du Code de la
                                consommation ; sauf pour les biens d’occasion, il
                                est dispensé de prouver l’existence du défaut de
                                conformité du bien durant les six mois suivant la
                                délivrance du bien, délai porté à 24 mois à
                                compter du 18 mars 2016. <br />
                                <span style="display: block; margin: 5px 0"
                                  >La garantie légale de conformité s’applique
                                  indépendamment de la garantie commerciale
                                  éventuellement consentie par le Vendeur.
                                </span>
                                <span style="display: block; margin-bottom: 5px"
                                  >Le consommateur peut décider de mettre en œuvre
                                  la garantie contre les défauts cachés de la
                                  chose vendue au sens de l’article 1641 du Code
                                  civil, à moins que le vendeur n’ait stipulé
                                  qu’il ne sera obligé à aucune garantie ; dans
                                  l’hypothèse d’une mise en œuvre de cette
                                  garantie, l’acheteur a le choix entre la
                                  résolution de la vente ou une réduction du prix
                                  de vente conformément à l’article 1644 du Code
                                  civil. Il dispose d’un délai de deux années à
                                  compter de la découverte du vice</span
                                >
                                <span style="display: block"
                                  >Le report, la suspension ou l’interruption de
                                  la prescription ne peut avoir pour effet de
                                  porter le délai de prescription extinctive
                                  audelà de vingt ans à compter du jour de la
                                  naissance du droit conformément à l’article 2232
                                  du Code civil.
                                </span>
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table>
                            <tr>
                              <td
                                style="
                                  font-size: 7px;
                                  text-align: justify;
                                  line-height: 10px;
                                  letter-spacing: 0.3px;
                                "
                              >
                                Les garanties légales s'appliqueront
                                indépendamment de la garantie commerciale
                                éventuellement proposée par le Vendeur et qui
                                ferait l’objet d’un contrat de garantie
                                commerciale distinct.
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table>
                            <tr>
                              <td
                                style="
                                  font-size: 7px;
                                  text-align: justify;
                                  line-height: 10px;
                                  letter-spacing: 0.3px;
                                "
                              >
                                <strong style="font-weight: 800"
                                  >14. 1. La garantie légale de conformité</strong
                                >
                                - Tous les produits fournis par le Vendeur
                                bénéficient de la garantie légale de conformité
                                prévue aux articles L. 217-4 à L. 217-14 du Code
                                de la consommation ou de la garantie des vices
                                cachés prévue aux articles 1641 à 1649 du Code
                                civil. Le Vendeur doit livrer un bien conforme au
                                contrat. A défaut il est responsable des défauts
                                lors de la délivrance, mais également de tout ceux
                                résultant de l’emballage, des instructions de
                                montage ou de l’installation lorsqu’elle est à la
                                charge du contrat ou sous sa responsabilité.
                                <br />
                                L’action en garantie de conformité se prescrit par
                                2 ans à compter de la délivrance du bien.
                                Lorsqu’il y a défaut de conformité, le
                                professionnel propose au consommateur le
                                remplacement du bien ou sa réparation. Le choix
                                dépend du consommateur, sauf lorsque celui - ci
                                engendre pour le professionnel des coûts
                                disproportionnés par rapport à second moyen.
                                <br />
                                Le consommateur peut obtenir la résolution du
                                contrat ou sa réfaction (réduction du prix du
                                bien) si le défaut est majeur et que le délai de
                                la solution choisie excède 1 mois à partir de la
                                demande ; ou qu’aucun moyen n’est réalisable.
                                <br />
                                Aucun frais ne peut être demandé au consommateur
                                pour le remplacement, la réparation, la résolution
                                ou la réfaction du contrat. <br />
                                <strong style="font-weight: 800"
                                  >14. 2. La garantie des défauts cachés</strong
                                >
                                - Le Vendeur est par ailleurs tenu de la garantie
                                à raison des défauts cachés de la chose vendue qui
                                la rendent impropre à l’usage auquel on la
                                destine, ou qui diminuent tellement cet usage, que
                                l’Acheteur ne l’aurait pas acquise, ou n’en aurait
                                donné qu’un moindre prix, s’il les avait connus
                                <br />
                                La garantie légale couvre tous les frais entraînés
                                par les vices cachés. L’Acheteur à ici le choix
                                soit de rendre la chose et se faire restituer le
                                prix soit de garder la chose et se faire rendre
                                une partie du prix. Le délai pour agir est de 2
                                ans à compter de la découverte du vice. Les
                                produits sont vendus sous la seule garantie du
                                fabricant et sont assortis d’un bon de garantie
                                remis à l’Acheteur par le Vendeur <br />
                                
                                
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                    </table>
                  </td>


                  <td style="width: 50%; vertical-align: baseline">
                    <table style="width: 100%; border-spacing: 25px">
                      <tr>
                        <td>
                          <table>
                            <tr>
                              <td
                                style="
                                  font-size: 7px;
                                  line-height: 10px;
                                  letter-spacing: 0.3px;
                                  text-align: justify;
                                "
                              >
                                <strong style="font-weight: 800"
                                  >ARTICLE 12 : Clause pénale</strong
                                >
                                <br />
                                Dans tous les cas d’inexécution de ses obligations
                                par l’Acheteur, celui-ci devra, à titre <br>
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table>
                            <tr>
                              <td
                                style="
                                  font-size: 7px;
                                  line-height: 10px;
                                  letter-spacing: 0.3px;
                                  text-align: justify;
                                "
                              > 
                                d’indemnité, au Vendeur un montant égal à 50 % du
                                montant de la commande (hors aides et subventions
                                diverses), en plus, le cas échéant, du coût de la
                                désinstallation des matériaux installés. <br />
                                Toute personne dispose d’un droit d’accès, de
                                rectification, de portabilité, d’effacement de ses
                                données personnelles ou une limitation de leur
                                traitement, du droit d’opposition au traitement de
                                ses données pour des motifs légitimes et du droit
                                de retirer son consentement à tout moment. Enfin,
                                chacun dispose du droit d’introduire une
                                réclamation auprès d’une autorité de contrôle et
                                de définir des directives relatives au sort de ses
                                données personnelles après sa mort.
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table style="width: 100%">
                            <tr>
                              <td
                                style="
                                  font-size: 7px;
                                  line-height: 10px;
                                  letter-spacing: 0.3px;
                                  text-align: justify;
                                "
                              >
                                <strong style="font-weight: 800"
                                  >ARTICLE 18 : Droit applicable / Litiges</strong
                                >
                                <br />
                                Les présentes Conditions Générales de Vente et le
                                contrat sont soumis à la loi française. Le
                                tribunal compétent en cas de litige sera celui du
                                lieu de domicile du défendeur ou, au choix du
                                demandeur, du lieu de livraison effective du
                                Produit ou de la signature du contrat.
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table style="width: 100%">
                            <tr>
                              <td style="font-size: 9px; text-align: center">
                                <strong
                                  style="
                                    font-weight: 800;
                                    text-decoration: underline;
                                  "
                                  >EXTRAITS DES TEXTES LEGAUX</strong
                                >
                              </td>
                            </tr>
                            <tr>
                              <td
                                style="
                                  font-size: 7px;
                                  line-height: 10px;
                                  letter-spacing: 0.3px;
                                  text-align: justify;
                                "
                              >
                                <strong style="font-weight: 800; font-size: 9px"
                                  >Article L. 221-8 Code de la consommation
                                </strong>
                                <br />
                                Dans le cas d'un contrat conclu hors
                                établissement, le professionnel fournit au
                                consommateur, sur papier ou, sous réserve de
                                l'accord du consommateur, sur un autre support
                                durable, les informations prévues à l'article L.
                                221-5. <br />
                                Ces informations sont rédigées de manière lisible
                                et compréhensible.
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table>
                            <tr>
                              <td
                                style="
                                  font-size: 7px;
                                  line-height: 10px;
                                  letter-spacing: 0.3px;
                                  text-align: justify;
                                "
                              >
                                <strong style="font-weight: 800"
                                  >Article L. 221-9 Code de la
                                  consommation</strong
                                >
                                <br />
                                Le professionnel fournit au consommateur un
                                exemplaire daté du contrat conclu hors
                                établissement, sur papier signé par les parties
                                ou, avec l'accord du consommateur, sur un autre
                                support durable, confirmant l'engagement exprès
                                des parties <br />
                                Ce contrat comprend toutes les informations
                                prévues à l'article L. 221-5 <br />
                                Le contrat mentionne, le cas échéant, l'accord
                                exprès du consommateur pour la fourniture d'un
                                contenu numérique indépendant de tout support
                                matériel avant l'expiration du délai de
                                rétractation et, dans cette hypothèse, le
                                renoncement de ce dernier à l'exercice de son
                                droit de rétractation <br />
                                Le contrat est accompagné du formulaire type de
                                rétractation mentionné au 2° de l'article L.
                                221-5.
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table>
                            <tr>
                              <td
                                style="
                                  font-size: 7px;
                                  line-height: 10px;
                                  letter-spacing: 0.3px;
                                  text-align: justify;
                                "
                              >
                                <strong style="font-weight: 800"
                                  >Article L. 221-10 Code de la consommation
                                </strong>
                                <br />
                                Le professionnel ne peut recevoir aucun paiement
                                ou aucune contrepartie, sous quelque forme que ce
                                soit, de la part du consommateur avant
                                l'expiration d'un délai de sept jours à compter de
                                la conclusion du contrat hors établissement.
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table>
                            <td
                              style="
                                font-size: 7px;
                                line-height: 10px;
                                letter-spacing: 0.3px;
                                text-align: justify;
                              "
                            >
                              <strong style="font-weight: 800"
                                >Article L. 221-18 Code de la consommation
                              </strong>
                              <br />
                              Le consommateur dispose d'un délai de quatorze jours
                              pour exercer son droit de rétractation d'un contrat
                              conclu à distance, à la suite d'un démarchage
                              téléphonique ou hors établissement, sans avoir à
                              motiver sa décision ni à supporter d'autres coûts
                              que ceux prévus aux articles L. 221-23 à L. 221-25.
                              <br />
                              Le délai mentionné au premier alinéa court à compter
                              du jour :
                              <br />
                              1° De la conclusion du contrat, pour les contrats de
                              prestation de services et ceux mentionnés à
                              l'article L. 221-4 ; <br />
                              2° De la réception du bien par le consommateur ou un
                              tiers, autre que le transporteur, désigné par lui,
                              pour les contrats de vente de biens. Pour les
                              contrats conclus hors établissement, le consommateur
                              peut exercer son droit de rétractation à compter de
                              la conclusion du contrat <br />
                              Dans le cas d'une commande portant sur plusieurs
                              biens livrés séparément ou dans le cas d'une
                              commande d'un bien composé de lots ou de pièces
                              multiples dont la livraison est échelonnée sur une
                              période définie, le délai court à compter de la
                              réception du dernier bien ou lot ou de la dernière
                              pièce <br />
                              Pour les contrats prévoyant la livraison régulière
                              de biens pendant une période définie, le délai court
                              à compter de la réception du premier bien.
                            </td>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table>
                            <tr>
                              <td
                                style="
                                  font-size: 7px;
                                  line-height: 10px;
                                  letter-spacing: 0.3px;
                                  text-align: justify;
                                "
                              >
                                <strong style="font-weight: 800"
                                  >Article L. 217-4 Code de la
                                  consommation</strong
                                >
                                <br />
                                Le vendeur est tenu de livrer un bien conforme au
                                contrat et répond des défauts de conformité
                                existant lors de la délivrance. Il répond
                                également des défauts de conformité résultant de
                                l'emballage, des instructions de montage ou de
                                l'installation lorsque celle-ci a été mise à sa
                                charge par le contrat ou a été réalisée sous sa
                                responsabilité.
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table>
                            <tr>
                              <td
                                style="
                                  font-size: 7px;
                                  line-height: 10px;
                                  letter-spacing: 0.3px;
                                  text-align: justify;
                                "
                              >
                                <strong style="font: weight 800"
                                  >Article L. 217-5 Code de la
                                  consommation</strong
                                >
                                <br />
                                Le bien est conforme au contrat : <br />
                                S'il est propre à l'usage habituellement attendu
                                d'un bien semblable et, le cas échéant : <br />
                                s'il correspond à la description donnée par le
                                vendeur et possède les qualités que celui-ci a
                                présentées à l'acheteur sous forme d'échantillon
                                ou de modèle ; <br />
                                - s'il présente les qualités qu'un acheteur peut
                                légitimement attendre eu égard aux déclarations
                                publiques faites par le vendeur, par le producteur
                                ou par son représentant, notamment dans la
                                publicité ou l'étiquetage ; <br />
                                Ou s'il présente les caractéristiques définies
                                d'un commun accord par les parties ou est propre à
                                tout usage spécial recherché par l'acheteur, porté
                                à la connaissance du vendeur et que ce dernier a
                                accepté <br />
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                     
                      
                    </table>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
    </div>

    {{-- ====================four====================== --}}

    <div class="page" style="page-break-before: always;">
        <table
          cellpadding="0"
          cellspacing="0"
          style="width: 100%; font-family: sans-serif">
          <tr>
            <td>
              <table>
                <tr>
                  <td style="width: 50%; vertical-align: baseline">
                    <table style="width: 100%; border-spacing: 25px">
                      <tr>
                        <td>
                          <table>
                            <tr>
                              <td
                                style="
                                  font-size: 7px;
                                  text-align: justify;
                                  line-height: 10px;
                                  letter-spacing: 0.3px;
                                "
                              >La garantie du fabricant sur le matériel s’étend
                              sur une durée de 3 ans pour les pièces, 5 ans pour
                              les compresseurs, 5 ans sur les onduleurs. Les
                              cellules composant les modules sont garanties 25
                              ans à 80% de leur puissance normale. Cette
                              garantie prévoit l ’échange gratuit de la pièce
                              défectueuse en usine. Les frais de dépose, pose et
                              transport sont à la charge de l’Adhérent. La
                              garantie sur une pièce de remplacement expire en
                              même temps que celle de la pièce remplacée. Tous
                              les autres éléments tels que diffuseurs, panneaux
                              solaires, ballons d’eau chaude, sanitaires,
                              télécommandes, composants électroniques, pompes de
                              relevage, disjoncteurs, liaison frigorifiques,
                              câbles électriques, goulottes, etc ... sont
                              garantis un an. En cas de dommages dus au
                              transport des articles susvisés, il appartient à
                                l’Acheteur d’en faire la réserve dès la livraison
                                et d’en aviser le Vendeur <br />
                                En cas d’invocation de la garantie, la
                                présentation du certificat de garantie sera
                                rigoureusement exigée. Le Vendeur s’engage à
                                intervenir dans un délai de 30 jours à compter de
                                la réception de la demande d’intervention, qui
                                sera obligatoirement formulée par écrit avec
                                accusé de réception, sous réserve d’être en
                                possession des éléments
                                par écrit avec
                                accusé de réception, sous réserve d’être en
                                possession des éléments nécessaires à la
                                réparation ou au remplacement
                                <br />
                                <strong style="font-weight: 800"
                                  >14.3. Garantie décennale</strong
                                >
                                - L’assurance de responsabilité civile décennale
                                garantit la réparation des dommages qui se
                                produisent après la réception des travaux. La
                                garantie décennale concerne les vices ou dommages
                                de construction qui peuvent affecter la solidité
                                de l’ouvrage et de ses équipements indissociables
                                ou qui la rendent inhabitable ou impropre à
                                l’usage auquel il est destiné <br />
                                La garantie décennale couvre le dommage résultant
                                d’un défaut de conformité affectant le gros
                                ouvrage (murs, charpente, toiture, etc.) mais
                                également les éléments d’équipement lorsque les
                                dysfonctionnements les affectant rendent le bien
                                dans son ensemble impropre à sa destination <br />
                                La garantie décennale couvre les dommages survenus
                                après la réception des travaux, pendant une durée
                                de 10 ans.
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table>
                            <tr>
                              <td style="font-size: 9px">
                                <strong style="font-weight: 800"
                                  >ARTICLE 15 : Exclusion de responsabilité et
                                  force majeure</strong
                                >
                              </td>
                            </tr>
                            <tr>
                              <td
                                style="
                                  font-size: 7px;
                                  text-align: justify;
                                  line-height: 10px;
                                  letter-spacing: 0.3px;
                                "
                              >
                                <strong style="font-weight: 800"
                                  >15.1.- Exclusion de responsabilité</strong
                                >
                                - La responsabilité du Vendeur ne peut être
                                engagée dans les cas suivants : <br />
                                <ul
                                  style="
                                    margin-left: 13px;
                                    margin-top: 5px;
                                    line-height: 12px;
                                  "
                                >
                                  <li>
                                    Non-paiement partiel ou total du montant de la
                                    commande ;
                                  </li>
                                  <li>
                                    Détérioration des appareils provenant
                                    directement ou indirectement d’accidents de
                                    toutes sortes, chocs, surtensions, foudre,
                                    inondations, incendie, et d’une manière
                                    générale, toutes autres causes autre que
                                    celles résultant d’une utilisation normale ;
                                  </li>
                                  <li>
                                    Mauvais fonctionnement résultant d’adjonction
                                    de pièces ou dispositifs ne provenant pas du
                                    Vendeur ;
                                  </li>
                                  <li>
                                    Intervention de quelque nature que ce soir par
                                    une personne non agréée par le Vendeur ;
                                  </li>
                                  <li>
                                    Variation du courant électrique, dérangement,
                                    panne ou rupture des lignes téléphoniques ;
                                  </li>
                                  <li>
                                    Modifications dommageables de l’environnement
                                    de l’appareil (température, hygrométrie,
                                    poussières) ;
                                  </li>
                                  <li>
                                    Modification des spécifications d’un appareil
                                    ou utilisation non conforme aux
                                    caractéristiques techniques - interférence et
                                    brouillage de toutes sortes, radioélectrique
                                    ou électrique ;
                                  </li>
                                  <li>
                                    Les perturbations de fonctionnement dues à un
                                    évènement relevant de la force majeure ;
                                  </li>
                                  <li>
                                    Non-respect des consignes d’utilisation des
                                    matériaux et ou des notices d’utilisation du
                                    matériel délivré ;
                                  </li>
                                  <li>
                                    Utilisation des appareils dans des conditions
                                    non conformes à leur usage ;
                                  </li>
                                  <li>Défaut d’entretien et de maintenance.</li>
                                  <li>Vices apparents ;</li>
                                  <li>
                                    Défauts et détériorations provoqués par
                                    l’usure naturelle ou par une modification du
                                    produit non prévue
                                  </li>
                                </ul>
                                <br />
                                <strong style="font-weight: 800"
                                  >15.2.- Autres causes d’exclusion de
                                  responsabilité du Vendeur</strong
                                >
                                - La responsabilité du Vendeur ne peut être
                                engagée en cas d’inexécution ou de mauvaise
                                exécution du contrat due, soit au fait de
                                l’Acheteur, soit au fait insurmontable et
                                imprévisible d’un tiers au contrat, soit à un cas
                                de force majeure au sens de l’article 1218 du Code
                                civil. <br />
                                La responsabilité du Vendeur ne saurait être
                                engagée à raison : <br />
  
                                <ul
                                  style="
                                    margin-left: 13px;
                                    margin-top: 5px;
                                    line-height: 12px;
                                  "
                                >
                                  <li>
                                    des conditions d’octroi et de montant du
                                    crédit d’impôt auquel l’Adhérent peut
                                    prétendre ainsi qu’à toute évolution légale ou
                                    réglementaire en la matière ;
                                  </li>
                                  <li>
                                    de toute évolution ou suppression des aides
                                    d’état existantes ou jour de la souscription
                                    du présent contrat par l’Adhérent.
                                  </li>
                                </ul>
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table>
                            <tr>
                              <td style="font-size: 9px">
                                <strong style="font-weight: 800"
                                  >ARTICLE 16 : Réclamations et médiation
                                </strong>
                              </td>
                            </tr>
                            <tr>
                              <td
                                style="
                                  font-size: 7px;
                                  text-align: justify;
                                  line-height: 10px;
                                  letter-spacing: 0.3px;
                                "
                              >
                                <strong style="font-weight: 800"
                                  >16. 1. - Réclamation préalable</strong
                                >
                                - En cas de litige, l’Acheteur doit adresser sa
                                réclamation écrite au Service Clients du Vendeur
                                situé au 2 RUE DU PRE DES AULNES 77340
                                PONTAULT-COMBAULT ainsi qu’au numéro suivant : 01.
                                87 . 66 . 57 . 30 <br />
                                <strong style="font-weight: 800"
                                  >16. 2. Demande de médiation</strong
                                >
                                - En cas d'échec de la demande de réclamation
                                auprès du service consommateurs du Vendeur ou en
                                l'absence de réponse de ce service dans un délai
                                de deux (2) mois, l’Acheteur peut soumettre le
                                différend l'opposant au Vendeur à la Commission
                                Paritaire de Médiation de la Vente Directe : 100,
                                avenue du Président Kennedy 75016 Paris - tél. :
                                01 42 15 30 00 - email : info@fvd.fr, qui
                                recherchera gratuitement un règlement à l'amiable
                                <br />
                                L’Adhérent reconnait que la Commission Paritaire
                                de Médiation de la Vente Directe a compétence
                                exclusive pour traiter, dans le cadre d'un
                                processus de médiation, les différends nés de la
                                Commande, des Produits, ou des CGV. Ni le Vendeur
                                ni l‘Acheteur ne peuvent utiliser un autre système
                                de médiation. <br />
                                L’Adhérent reconnait que la Commission Paritaire
                                de Médiation de la Vente Directe a compétence
                                exclusive pour traiter, dans le cadre d'un
                                processus de médiation, les différends nés de la
                                Commande, des Produits, ou des CGV. Ni le Vendeur
                                ni l‘Acheteur ne peuvent utiliser un autre système
                                de médiation.
                               
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      
                    </table>
                  </td>


                  <td style="width: 50%; vertical-align: baseline">
                    <table style="width: 100%; border-spacing: 25px">
                      <tr>
                        <td>
                          <table>
                            <tr>
                              <td
                                style="
                                  font-size: 7px;
                                  line-height: 10px;
                                  letter-spacing: 0.3px;
                                  text-align: justify;
                                "
                              >
                                <strong style="font-weight: 800"
                                  >Article L217-12 Code de la consommation</strong
                                >
                                <br />
                                L'action résultant du défaut de conformité se
                                prescrit par deux ans à compter de la délivrance
                                du bien.
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table>
                            <tr>
                              <td
                                style="
                                  font-size: 7px;
                                  line-height: 10px;
                                  letter-spacing: 0.3px;
                                  text-align: justify;
                                "
                              >
                                <strong style="font-weight: 800"
                                  >Article L. 217-16 Code de la Consommation :
                                </strong>
                                <br />
                                Lorsque l'acheteur demande au vendeur, pendant le
                                cours de la garantie commerciale qui lui a été
                                consentie lors de l'acquisition ou de la
                                réparation d'un bien meuble, une remise en état
                                couverte par la garantie, toute période
                                d'immobilisation d'au moins
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table>
                            <tr>
                              <td
                                style="
                                  font-size: 7px;
                                  line-height: 10px;
                                  letter-spacing: 0.3px;
                                  text-align: justify;
                                  vertical-align:baseline;
                                "
                              >
                               sept jours vient
                                s'ajouter à la durée de la garantie qui restait à
                                courir. Cette période court à compter de la
                                demande d'intervention de l'acheteur ou de la mise
                                à disposition pour réparation du bien en cause, si
                                cette mise à disposition est postérieure à la
                                demande d'intervention
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table>
                            <tr>
                              <td
                                style="
                                  font-size: 7px;
                                  line-height: 10px;
                                  letter-spacing: 0.3px;
                                  text-align: justify;
                                "
                              >
                                <strong style="font-weight: 800"
                                  >Article 1641 Code civil
                                </strong>
                                <br />
                                Le vendeur est tenu de la garantie à raison des
                                défauts cachés de la chose vendue qui la rendent
                                impropre à l'usage auquel on la destine, ou qui
                                diminuent tellement cet usage, que l'acheteur ne
                                l'aurait pas acquise, ou n'en aurait donné qu'un
                                moindre prix, s'il les avait connus.
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table>
                            <tr>
                              <td
                                style="
                                  font-size: 7px;
                                  line-height: 10px;
                                  letter-spacing: 0.3px;
                                  text-align: justify;
                                "
                              >
                                <strong style="font-weight: 800"
                                  >Article 1648 alinéa 1er Code civil</strong
                                >
                                <br />
                                L'action résultant des vices rédhibitoires doit
                                être intentée par l'acquéreur dans un délai de
                                deux ans à compter de la découverte du vice.
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table>
                            <tr>
                              <td
                                style="
                                  font-size: 7px;
                                  line-height: 10px;
                                  letter-spacing: 0.3px;
                                  text-align: justify;
                                "
                              >
                                <strong style="font-weight: 800"
                                  >Article L312-47 du code de la consommation
                                </strong>
                                <br />
                                Tant que le prêteur ne l'a pas avisé de l'octroi
                                du crédit, et tant que l'emprunteur peut exercer
                                sa faculté de rétractation, le vendeur n'est pas
                                tenu d'accomplir son obligation de livraison ou de
                                fourniture. Toutefois, lorsque par une demande
                                expresse rédigée, datée et signée de sa main même,
                                l'acheteur sollicite la livraison ou la fourniture
                                immédiate du bien ou de la prestation de services,
                                le délai de rétractation ouvert à l'emprunteur par
                                l'article L. 312-19 expire à la date de la
                                livraison ou de la fourniture, sans pouvoir ni
                                excéder quatorze jours ni être inférieur à trois
                                jours <br />
                                Toute livraison ou fourniture anticipée est à la
                                charge du vendeur qui en supporte tous les frais
                                et risques.
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table>
                            <tr>
                              <td
                                style="
                                  font-size: 7px;
                                  line-height: 10px;
                                  letter-spacing: 0.3px;
                                  text-align: justify;
                                "
                              >
                                <strong style="font-weight: 800"
                                  >Article L312-52 du code de la consommation
                                  :</strong
                                >
                                <br />
                                Le contrat de vente ou de prestation de services
                                est résolu de plein droit, sans indemnité : <br />
                                1° Si le prêteur n'a pas, dans un délai de sept
                                jours à compter de l'acceptation du contrat de
                                crédit par l'emprunteur, informé le vendeur de
                                l'attribution du crédit ; <br />
                                2° Ou si l'emprunteur a exercé son droit de
                                rétractation dans le délai prévu à l'article L.
                                312-19. <br />
                                Toutefois, lorsque l'emprunteur, par une demande
                                expresse, sollicite la livraison ou la fourniture
                                immédiate du bien ou de la prestation de services,
                                l'exercice du droit de rétractation du contrat de
                                crédit n'emporte résolution de plein droit du
                                contrat de vente ou de prestation de services que
                                s'il intervient dans un délai de trois jours à
                                compter de l'acceptation du contrat de crédit par
                                l'emprunteur. <br />
                                Le contrat n'est pas résolu si, avant l'expiration
                                des délais mentionnés au présent article,
                                l'acquéreur paie comptant.
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table>
                            <tr>
                              <td
                                style="
                                  font-size: 7px;
                                  line-height: 10px;
                                  letter-spacing: 0.3px;
                                  text-align: justify;
                                "
                              >
                                <strong style="font-weight: 800"
                                  >Article L312-53 du code de la consommation
                                  :</strong
                                >
                                <br />
                                Dans les cas de résolution du contrat de vente ou
                                de prestations de services prévus à l'article L.
                                312-52, le vendeur ou le prestataire de services
                                rembourse, sur simple demande, toute somme que
                                l'acheteur aurait versée d'avance sur le prix
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table>
                            <tr>
                              <td
                                style="
                                  font-size: 7px;
                                  line-height: 10px;
                                  letter-spacing: 0.3px;
                                  text-align: justify;
                                "
                              >
                                <strong style="font-weight: 800"
                                  >Article L341-10 du code de la
                                  consommation:</strong
                                >
                                <br />
                                Dans les cas de résolution du contrat de vente ou
                                de prestations de services prévus à l'article L.
                                312-53, à compter du huitième jour suivant la
                                demande de remboursement de toute somme versée
                                d'avance par l'acheteur, cette somme est
                                productive d'intérêts, de plein droit, au taux de
                                l'intérêt légal majoré de moitié.
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table>
                            <tr>
                              <td
                                style="
                                  font-size: 7px;
                                  line-height: 10px;
                                  letter-spacing: 0.3px;
                                  text-align: justify;
                                "
                              >
                                <strong style="font-weight: 800"
                                  >Article L312-49 du code de la consommation
                                  :</strong
                                >
                                <br />
                                NOVECOLOGY doit conserver une copie du contrat de
                                crédit et la présente sur leur demande aux agents
                                chargés du contrôle.
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
    </div>

    {{-- five --}}

    <div class="page">
        <table
          cellpadding="0"
          cellspacing="0"
          style="width: 100%; font-family: sans-serif">

          <tr>
            <td>
              <table>
                <tr>
                  <td style="width: 50%; vertical-align: baseline">
                    <table style="width: 100%; border-spacing: 25px">
                      <tr>
                        <td>
                          <table>
                            <tr>
                              <td style="font-size: 9px">
                                <strong
                                  >ARTICLE 17 : Protection des données à caractère
                                  personnel</strong
                                >
                              </td>
                            </tr>
                            <tr>
                              <td
                                style="
                                  font-size: 7px;
                                  text-align: justify;
                                  line-height: 10px;
                                  letter-spacing: 0.3px;
                                "
                              >
                                Conformément à la loi n° 78-17 du 6 janvier 1978
                                modifiée (dite « loi Informatique et Libertés »)
                                et au Règlement Général sur la Protection des
                                Données 2016/679 du 27 avril 2016 (« RGPD »), des
                                données à caractère personnel concernant les
                                Adhérents font l’objet d ’un traitement
                                informatique par le Vendeur agissant en qualité de
                                responsable de traitement pour notamment :
                                effectuer des opérations relatives à la gestion
                                des relations commerciales dans le cadre de la
                                fourniture de tous produits, faciliter l’
                                identification des Adhérents et informer les
                                Adhérents de toute modification apportée aux
                                produits et services NOVECOLOGY les améliorer,
                                mener des actions de prospection et des analyses
                                statistiques.
                                Les professionnels du secteur ont élaboré des
                                règles déontologiques sous la forme d'un Code
                                éthique envers le consommateur et d'un Code de
                                conduite des entreprises de Vente Directe. Le
                                consommateur peut prendre connaissance de ces
                                Codes sur le site internet de la Fédération de la
                                Vente Directe
                                <a href="https://www.fvd.fr/en/">(www.fvd.fr)</a>.
                                <br />
                                Pour présenter sa demande de médiation, l‘Acheteur
                                dispose d'un formulaire de réclamation accessible
                                sur le site du médiateur. Les parties au contrat
                                restent libres d'accepter ou de refuser le recours
                                à la médiation ainsi que, en cas de recours à la
                                médiation, d'accepter ou de refuser la solution
                                proposée par le médiateur
                                <br />
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table>
                            <tr>
                              <td
                                style="
                                  font-size: 7px;
                                  text-align: justify;
                                  line-height: 10px;
                                  letter-spacing: 0.3px;
                                "
                              >
                                Ces données ne sont pas susceptibles d’être
                                transférées dans des pays non- membres de l’Espace
                                Économique Européen. Pour les stricts besoins de
                                la gestion des relations commerciales, ces données
                                peuvent être communiquées aux partenaires du
                                Vendeur. Ces données sont conservées pendant la
                                durée strictement nécessaire à l’accomplissement
                                des finalités rappelées ci-dessus
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                    </table>
                  </td>


                  <td style="width: 50%; vertical-align: baseline">
                    <table style="width: 100%; border-spacing: 25px">
      
                    </table>
                  </td>
                </tr>
              </table>
            </td>
          </tr>

          <tr>
            <td>
              <table style="width: 100%" cellspacing="0" cellpadding="0">
                <tr>
                  <td
                    style="
                      font-size: 9px;
                      background-color: #d9d9d9;
                      border-spacing: 25px;
                      text-align: center;
                      padding: 5px 0;
                      border: 1px solid #000000;
                    "
                  >
                    <strong>BORDEREAU DE RETRACTATION</strong>
                  </td>
                </tr>
                <tr>
                  <td
                    style="
                      border: 1px solid #000000;
                      font-size: 7px;
                      line-height: 10px;
                      letter-spacing: 0.3px;
                      text-align: justify;
                      padding: 2px 5px;
                    "
                  >
                    <table style="width: 100%">
                      <tr>
                        <td>
                          <table>
                            <tr>
                              <td>
                                Le consommateur dispose d’un délai de quatorze
                                (14) jours à compter soit de leur réception pour
                                les équipements, et si plusieurs produits sont
                                commandés dans une seule Commande, au moment de la
                                réception du dernier bien commandé, soit de la
                                validation de la commande pour les prestations,
                                pour exercer son droit de rétraction d’un contrat
                                conclu à distance ou hors établissement, sans
                                avoir à motiver sa décision ni à supporter
                                d’autres coûts que ceux prévus aux articles
                                L.221-18 à L.221-29 du Code de la consommation
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table style="width: 100%">
                            <tr>
                              <td style="width: 50%">
                                Numéro de bon de commande / devis :
                              </td>
                              <td>
                                Je vous notifie par la présente ma rétractation du
                                devis portant sur la vente du bien ci-dessous :
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table>
                            <tr>
                              <td>
                                Je vous notifie par la présente ma rétractation du
                                devis portant sur la vente du bien ci-dessous :
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table style="width: 100%">
                            <tr>
                              <td>Commande reçue le ……………………………………..….</td>
                              <td>Nom du consommateur ……………………………………..….</td>
                              <td>Adresse du consommateur ……………………………………..….</td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table>
                            <tr>
                              <td style="text-decoration: underline">
                                Effets de la rétractation
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table>
                            <tr>
                              <td>
                                En cas de rétractation de votre part du présent
                                contrat, nous vous rembourserons tous les
                                paiements reçus de vous, y compris les frais de
                                livraison (à l'exception des frais supplémentaires
                                découlant du fait que vous avez choisi, le cas
                                échéant, un mode de livraison autre que le mode
                                moins coûteux de livraison standard proposé par
                                nous) sans retard excessif et, en tout état de
                                cause, au plus tard quatorze jours à compter du
                                jour où nous sommes informés de votre décision de
                                rétractation du présent contrat. Nous procéderons
                                au remboursement en utilisant le même moyen de
                                paiement que celui que vous aurez utilisé pour la
                                transaction initiale, sauf si vous convenez
                                expressément d'un moyen différent ; en tout état
                                de cause, ce remboursement n'occasionnera pas de
                                frais pour vous. Nous récupérerons le bien.
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <table>
                            <tr>
                              <td>Signature du consommateur</td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <!-- <tr>
                        <td>
                          
                        </td>
                      </tr>
                      <tr>
                        
                      </tr>
                      <tr>
                        <td>
                          Je vous notifie par la présente ma rétractation du devis
                          portant sur la vente du bien ci-dessous :
                        </td>
                      </tr>
                      <tr>
                        <td>Commande reçue le ……………………………………..…</td>
                        <td>Nom du consommateur ……………………………………..…</td>
                        <td>Adresse du consommateur ……………………………………..…</td>
                      </tr> -->
                    </table>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
    </div>



    

    {{-- <script>
        window.print();
    </script>  --}}
  </body>
</html>
