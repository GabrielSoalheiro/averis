@extends('food.default', ['title' => 'Carrinho'])
@section('content')

<div class="minfit" style="min-height: 472px;">
	<div class="middle">
		<div class="container nopaddmobile">
			<div class="row rowtitle">
				<div class="col-md-12">
					<div class="title-icon">
						<span>Fechar Pedido</span>
					</div>
					<div class="bread-box">
						<div class="bread">
							<a href="{{ route('food.index', ['link='.$config->loja_id]) }}"><i class="lni lni-home"></i></a>
							<span>/</span>
							<a href="{{ route('food.carrinho', ['link='.$config->loja_id]) }}">Meu carrinho</a>
						</div>
					</div>
				</div>
				<div class="col-md-12 hidden-xs hidden-sm">
					<div class="clearline"></div>
				</div>
			</div>
			<div class="sacola">
				<div id="the_form" novalidate="novalidate">
					<div class="row">
						<div class="col-md-12">
							<table class="listing-table sacola-table">
								<thead>
									<tr><th></th>
										<th>Nome</th>
										<th>Qtd</th>
										<th>Valor</th>
										<th>SubTotal</th>
										<th>Detalhes</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									@if($carrinho)
									@foreach($carrinho->itens as $i)
									<tr class="sacola-alterar sacola-{{ $i->id }}" sacola-produto-id="{{ $i->produto_id }}" sacola-eid="{{ $i->id }}" sacola-pid="{{ $i->produto_id }}" valor-adicional="0" valor-somado="{{ $i->sub_total 	}}">
										<td class="td-foto">
											<a href="{{ route('food.produto-detalhe', [$i->produto->hash_delivery]) }}">
												<div class="imagem">
													<img src="{{ $i->produto->img }}">
												</div>
											</a>
										</td>
										<td class="td-nome">
											<a href="">
												<span class="nome">
													@if($i->tamanho)
													@foreach($i->pizzas as $pizza)
													1/{{ sizeof($i->pizzas) }} {{ $pizza->sabor->nome }} @if(!$loop->last) | @endif
													@endforeach
													- Tamanho: <strong>{{ $i->tamanho->nome }}</strong>
													@else
													{{ $i->produto->nome }}
													@endif
												</span>
											</a>
										</td>
										<td class="td-detalhes visible-xs visible-sm">
											<div class="line detalhes">
												<span>
													{{ $i->observacao }}
												</span>
											</div>
										</td>
										<td class="td-quantidade">
											<div class="clear"></div>
											<div class="holder-acao">
												<div class="item-acao visible-xs visible-sm">
													<a class="sacola-change" style="display:none" href="{{ route('food.produto-detalhe', [$i->produto->hash_delivery]) }}">
														<i class="lni lni-pencil"></i>
													</a>
												</div>
												<div class="item-acao">
													<div class="line quantidade">
														<div class="clear"></div>
														<div class="campo-numero">
															<i class="decrementar lni lni-minus" sacola-eid="{{ $i->id }}"></i>
															<input readonly="" id="quantidade" type="number" name="quantidade" value="{{ number_format($i->quantidade, 0) }}">
															<i class="incrementar lni lni-plus" sacola-eid="{{ $i->id }}"></i>
														</div>
														<div class="clear"></div>
													</div>
												</div>
												<div class="item-acao visible-xs visible-sm">
													<a class="sacola-remover" href="#" sacola-eid="{{ $i->id }}">
														<i class="lni lni-trash"></i>
													</a>
												</div>
											</div>
										</td>
										<td class="td-valor">
											<span>Valor:</span>
											<div class="line valor">
												<span>R$ {{ __moeda($i->valor_unitario) }}</span>
											</div>
										</td>
										<td class="td-valor">
											<span>Sub total:</span>
											<div class="line valor">
												<span class="sub_total_item">R$ {{ __moeda($i->sub_total) }}</span>
											</div>
										</td>
										<td class="td-detalhes hidden-xs hidden-sm">
											<div class="line detalhes">
												<span>
													{{ $i->observacao }}
												</span>
											</div>
										</td>
										<td class="td-acoes hidden-xs hidden-sm">
											<div class="holder">
												<a class="sacola-remover" href="#" sacola-eid="{{ $i->id }}">
													<i class="lni lni-trash"></i>
													<span class="visible-xs">Excluir</span>
												</a>
											</div>
											<div class="clear visible-xs visible-sm"></div>
										</td>
									</tr>
									@if(sizeof($i->adicionais) > 0)
									<tr class="sacola-{{ $i->id }}">
										<td colspan="5">
											Adicionais: 
											@foreach($i->adicionais as $a)
											<strong>{{ $a->adicional->nome }}@if(!$loop->last), @endif</strong>
											@endforeach
										</td>
									</tr>
									@endif
									@endforeach
									@else
									<tr class="sacola-null">
										<td colspan="6"><span class="nulled">Sua sacola de compras está vazia, adicione produtos para poder fazer o seu pedido!</span></td>
									</tr>
									@endif
								</tbody>
							</table>
						</div>
					</div>
					<div class="linha-subtotal">
						<div class="row error-pedido-minimo error-pedido-minimo-sacola">
							<div class="col-md-12">
								<input class="fake-hidden" name="pedido_minimo" value="{{ $config->pedido_minimo }}">
							</div>
						</div>

						@if($funcionamento && $funcionamento->aberto)
						@if($carrinho && $carrinho->valor_total >= $config->pedido_minimo)
						<div class="row">
							<div class="col-md-4">
								<div class="subtotal"><strong>Subtotal:</strong> <span class="subtotal-valor">R$ {{ $carrinho ? __moeda($carrinho->valor_total) : '0,00' }}</span></div>
							</div>
							<div class="clear visible-xs visible-sm"><br></div>
							<div class="col-md-3">
								<form method="get" action="{{ route('food.pagamento') }}">

									<input class="fake-hidden" name="delivery" value="1">
									<input type="hidden" name="link" value="{{ $config->loja_id }}" />

									<button class="botao-acao"><i class="lni lni-bi-cycle"></i> <span>Delivery</span></button>
								</form>
							</div>
							<div class="clear visible-xs visible-sm"><br></div>
							<div class="col-md-3">
								<form method="get" action="{{ route('food.pagamento') }}">
									<input class="fake-hidden" name="balcao" value="1">
									<input type="hidden" name="link" value="{{ $config->loja_id }}" />

									<button class="botao-acao"><i class="lni lni-restaurant"></i> <span>Retirada Balcão</span></button>
								</form>
							</div>
							<div class="clear visible-xs visible-sm"><br></div>
						</div>
						@else

						<h5 class="text-primary">Pedido mínimo R$ {{ __moeda($config->pedido_minimo) }}</h5>

						@endif
						@else
						<div class="loja-fechada">
							<span><button>Fechado</button></span>
						</div>
						@endif
					</div>

				</div>

			</div>
		</div>
	</div>
</div>

@endsection
@section('js')
<script src="/food-files/js/carrinho.js"></script>
@endsection
