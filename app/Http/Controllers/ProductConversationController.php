<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductConversation;
use App\ProductMessage;
use App\Product;
use Auth;

class ProductConversationController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index()
    {
    	
		$buyerConversations = Auth::user()->buyer_product_conversations()->orderBy('created_at', 'desc')
		->paginate(20)->appends(request()->except('page'));
	
		$sellerConversations = Auth::user()->seller_product_conversations()->orderBy('created_at', 'desc')
		->paginate(20)->appends(request()->except('page'));
    	
    	return view('front.product_conversation.index', compact('buyerConversations', 'sellerConversations'));
    }

    public function store(Request $request)
    {
    	//cek apakah pembeli pernah ngobrol tentang produk
    	if ($this->isUniqueConversation($request)) {
    		$this->storeNewConversation($request);
    	} else {
    		$this->storeExistedConversation($request);
    	}

    	return "Pesan Terkirim";
    }

    public function show(ProductConversation $productConversation)
    {
    	if (!request()->ajax()) {
    		abort(404);
    	}
    	$product = $productConversation->product;
    	$messages = $productConversation->messages()->orderBy('created_at', 'asc')->get();
    	return view('front.product_conversation.show', compact('productConversation', 'product', 'messages'));
    }

    public function update(Request $request, ProductConversation $productConversation)
    {
    	$this->storeNewMessage($request, $productConversation);
    	
    	$product = $productConversation->product;
    	$messages = $productConversation->messages()->orderBy('created_at', 'asc')->get();
    	return view('front.product_conversation.show', compact('productConversation', 'product', 'messages'));
    }

    public function read(ProductConversation $productConversation)
    {
    	//read all message
    	foreach ($productConversation->messages as $m) {
    		if ($m->user->id != Auth::id()) {
    			$m->is_read = 1;
    			$m->save();
    		}
    	}

    	$product = $productConversation->product;
    	$messages = $productConversation->messages()->orderBy('created_at', 'asc')->get();
    	return view('front.product_conversation.show', compact('productConversation', 'product', 'messages'));
    }

    private function isUniqueConversation($request)
    {
    	return ! ProductConversation::where('product_id', $request->product_id)
    	->where('buyer_id', Auth::id())->count() > 0;
    }

    private function storeNewConversation($request)
    {
    	$conversation = new ProductConversation();
		$conversation->product_id = $request->product_id;
		$conversation->seller_id = Product::findOrFail($request->product_id)->store->user->id;
		$conversation->buyer_id = Auth::id();
		$conversation->save();
		$this->storeNewMessage($request, $conversation);
    }

    private function storeExistedConversation($request)
    {
    	$conversation = ProductConversation::where('product_id', $request->product_id)
		->where('buyer_id', Auth::id())->firstOrFail();
		$this->storeNewMessage($request, $conversation);
    }

    private function storeNewMessage($request, $conversation)
    {
    	//record message
		ProductMessage::create([
			'product_conversation_id' => $conversation->id,
			'user_id' => Auth::id(),
			'message' => $request->message
		]);
    }
}
