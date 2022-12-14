<style>
  body {
    background-color: rgb(45,25,124);
  }
  .todolist {
    margin: 10% 21%;
    height: auto;
    background-color: white;
    background-size: cover;
    border-radius: 10px; 
    padding: 20px;   
  }        
  .title-container{
    display: flex;
    align-items: center;
    justify-content: space-between;
  }
  .title-container-login{
    display: flex;
    padding:0 2px;
  }
  a{ text-decoration-line: none;}
  a:link{ color: rgb(205,241,26);} 
  a:visited { color: rgb(205,241,26); }
  a:hover { color: white; } 
  #logout a:link{ color: red;} 
  #logout a:visited { color: red; }
  #logout a:hover { color: white; } 
  .add-task{
    display: flex;
    align-items: center;
  }
  .text-add{
    border-radius: 5px;  
    border-color: lightgray;
    height: 40px;
    width:80%;
  }
  .text-edit{
    padding:6px 0;
    border-radius: 5px;  
    border-color: lightgray;
    height: 30px;
    width: 100%;
  }
  table {
    border-collapse: separate;
    border-spacing: 3px 10px;
    text-align: center;
    width:100%;
    justify-content: space-between;
  }  
  .tag{
    padding:5px 2px;
  }
  .tag_id{
    font-size:15px;
    padding:7px 2px;
    background:#E9E9ED;
    border-radius: 5px;  
  }
  .tag_id-result{
    font-size:12px;
    padding:5px 3px;
    background:#E9E9ED;
    border-radius: 5px;  
  }
  .btn {
    display: inline-block;
    padding: 0.3em 1em;
    text-decoration-line: none;
    border-radius: 4px;
    transition: .4s;
    background: white;   
    font-weight:bold;
  }
  .btn-lgt{
    color: red;
    border: solid 2.5px red;
    margin:6px 7px;
    margin-top:10px;
    width:60px;
    font-size:12px;
  }
  .btn-lgt:hover {
    background: red;
    color: white;
  }
  .btn-find {
    color: rgb(205,241,26);
    border: solid 2.5px rgb(205,241,26);
  }
  .btn-find:hover {
    background: rgb(205,241,26);
    color: white;
  }
  .btn-add {
    color: #DC70FA;
    border: solid 2.5px #DC70FA;
    writing-mode: vertical-rl;
  }
  .btn-add:hover {
    background: #DC70FA;
    color: white;
  }
  .btn-edit{
    color: #FA9770;
    border: solid 2.5px #FA9770;
    writing-mode: vertical-rl;
  }
  .btn-edit:hover {
    background: #FA9770;
    color: white;
  }
  .btn-delete{
    color: #71FADC;
    border: solid 2.5px #71FADC;
    writing-mode: vertical-rl;
  }
  .btn-delete:hover {
    background: #71FADC;
    color: white;
  }
</style>

<body>
@csrf
<div class="todolist">
  <div class="title-container">
    <div class="title-container-ttl">
      <h2>Todo List</h2>
    </div>
    <div class="title-container-login">
      @if (Auth::check())
      <p>???{{$user->name .'?????????????????????' .  ''}}</p>
      @if (count($errors) > 0)
      <ul>
        @foreach ($errors->all() as $error)
        <li>
          {{$error}}
        </li>
        @endforeach
      </ul>
      @endif
        <form method="POST" action="{{ route('logout') }}">   
        @csrf
        <a :href="route('logout')"
              onclick="event.preventDefault();
                  this.closest('form').submit();" id="logout" class="btn btn-lgt">???????????????</a>
          </form>
      @else
        @csrf
        <META http-equiv="Refresh" content="0;URL=/login">
      @endif  
    </div>
  </div>
    <button class="btn btn-find">
      <a href="/find">???????????????</a>
    </button>
    <form action="/add" method="post">
      @csrf
      @if ($errors->has('name'))
        <tr>
          <th>ERROR</th>
          <td>
            {{$errors->first('task')}}
          </td>
        </tr>
      @endif  
      <div class="add-task">
        <input type="text" class="text-add" name="task" required minlength="1" maxlength="20" >
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
          <div class="tag">
            <select class="tag_id" name="tag_id">
              @foreach($tags as $tag)
                <option value="{{$tag->id}}">{{$tag->tag}}</option>
              @endforeach  
            </select>
          </div>
        <button type="submit" class="btn btn-add">
          ??????
        </button>
      </div>
    </form>

  <table>   
    <tr>
      <div class="table-th">
        <th>?????????</th>
        <th>????????????</th>
        <th>??????</th>
        <th>??????</th>
        <th>??????</th>
      </div>     
    </tr>
  <ul>
    <div class="table-td">
      @foreach ($todos as $todo)  
      <tr>  
        <td>
          @if($todo->created_at === $todo->updated_at)
            {{$todo->created_at}}
          @else 
            {{$todo->updated_at}} 
          @endif
        </td>    
      @if (count($errors) > 0)
      <ul>
        @foreach ($errors->all() as $error)
        <li>
          {{$error}}
        </li>
        @endforeach
      </ul>
      @endif  
      <form action="/edit" method="POST">
        @csrf   
        <td>
          <input type="text" class=text-edit name="task" value=" {{$todo->task}}" size="20">                   
          <input type="hidden" name="id" value="{{$todo->id}}">  
        </td>          
        <td>
          <input type="hidden" >
            <div class="tag-btn">
              <select class="tag_id-result" name="tag_id">
                @foreach($tags as $tag)
                  <option  value="{{$tag->id}}" 
                  @if($tag->id==$todo->tag_id) selected @endif>{{$tag->tag}}</option>
                @endforeach  
              </select>
            </div>
        </td> 
        <td>
          <button type="submit" class="btn btn-edit">
            ??????
          </button> 
        </td> 
      </form>    
      <form action="/delete" method="POST">
        @csrf          
          <td>          
            <input type="hidden" name="id" value="{{$todo->id}}">            
              <button type="submit" class="btn btn-delete">
                ??????
              </button> 
          <td>
      </form>  
      </tr>     
      @endforeach
    </div>  
  </ul>
  </table>
</div>
</body>