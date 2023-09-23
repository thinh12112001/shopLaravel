<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\Product\ProductMainService;
use App\Models\Product;
use App\Models\Comment;
use Carbon\Carbon;

class ProductController extends Controller
{
    protected $productMainService;

    public function __construct(ProductMainService $productMainService) {
        $this->productMainService = $productMainService;
    }

    public function index($id ='', $slug ='') {
        $product = $this->productMainService->show($id);
        $productsMore = $this->productMainService->more($id);

        return view('products.content', [
            'title' => $product->name,
            'product' => $product,
            'products' => $productsMore
        ]);
    }

    public function quickview(Request $request) {

        $product_id = $request->product_id;
        $product = Product::find($product_id);

        $output['product_name'] = $product->name;
        $output['id_product'] = $product->id;
        $output['product_description'] = $product->description;
        $output['product_content'] = $product->content;
        $output['product_price'] = $product->price_sale != NULL ? number_format($product->price_sale , 0, ',', '.'). 'VNĐ' : number_format($product->price , 0, ',', '.'). 'VNĐ';
        $output['product_file'] = '<p><img width="100%" src="' .$product->file.'" ></p>';
        echo json_encode($output);
    }

    public function load_comment(Request $request) {
        $product_id = $request->input('product_id');
        $comments = Comment::select('comment_id', 'comment', 'comment_name', 'comment_date')
            ->where('comment_product_id', $product_id)
            ->where('comment_status', 1)
            ->get();

        $output = '';

        foreach ($comments as $key => $comment) {
            if ($comment->comment_name != 'Admin') {
                $output .= '
                    <div class="row style_comment">
                        <div class="col-md-2">
                            <img width="100%" src="' . url('/frontend/avatar/ariana_grande.png') . '"
                                class="img img-responsive img-thumbnail">
                        </div>
                        <div class="col-md-10">
                            <p style="color:green;">@' . $comment->comment_name . '</p>
                            <p style="color:black;"> ' . $comment->comment_date . '</p>
                            <p> ' . $comment->comment . '</p>
                        </div>
                    </div>
                    <p></p>
                ';

                // Display replies for this comment
                $reply_comments = Comment::select('comment', 'comment_name', 'comment_date')
                    ->where('comment_parent_comment', $comment->comment_id)
                    ->get();

                foreach ($reply_comments as $reply_comment) {
                    $output .= '
                        <div class="row style_comment" style="margin: 5px 40px">
                            <div class="col-md-2">
                                <img width="80%" src="' . url('/frontend/avatar/male-avatar-admin-profile.png') . '"
                                    class="img img-responsive img-thumbnail">
                            </div>
                            <div class="col-md-10">
                                <p style="color:blue;">@Admin</p>
                                <p style="color:black;"> ' . $reply_comment->comment_date . '</p>
                                <p> ' . $reply_comment->comment . '</p>
                            </div>
                        </div>
                        <p></p>
                    ';
                }
                $output.='<br/>';
            }
        }

        echo $output;
    }

    public function send_comment(Request $request) {
        $product_id = $request->input('product_id');
        $comment_name = $request->input('comment_name');
        $comment_content = $request->input('comment_content');
        $current_timestamp = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');

        $comment = new Comment();
        $comment->comment = $comment_content;
        $comment->comment_name = $comment_name;
        $comment->comment_product_id = $product_id;
        $comment->comment_date = $current_timestamp;
        $comment->comment_status = 0;
        $comment->save();


    }

    public function allow_comment(Request $request) {
        // $data = $request->all();

        $comment = Comment::find($request->input('comment_id'));
        $comment->comment_status = $request->input('comment_status');
        $comment->save();
    }

    public function reply_comment(Request $request) {
        $comment = new Comment();
        $current_timestamp = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
        // echo  $request->input('comment');
        $comment->comment = $request->input('comment');
        $comment->comment_product_id = $request->input('comment_product_id');
        $comment->comment_parent_comment = $request->input('comment_id');
        $comment->comment_status = 1;
        $comment->comment_name = 'Admin';
        $comment->comment_date = $current_timestamp;
        $comment->save();
    }
}
